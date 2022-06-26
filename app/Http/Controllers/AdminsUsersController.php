<?php

namespace App\Http\Controllers;

use App\AdminsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminsUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = AdminsUsers::with('profile')->orderBy('id', 'desc')->paginate(7);
        return view('admins/users/index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new AdminsUsers();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_role = $request->id_role;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->action('AdminsUsersController@index')->with('status', 'เพิ่มสมาชิกสำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = AdminsUsers::findOrFail($id);
        return view('admins.users.edit', ['users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = AdminsUsers::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_role = $request->id_role;

        $user->save();
        return redirect()->action('AdminsUsersController@index')->with('status', 'แก้ไขสมาชิกสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = AdminsUsers::find($id);

        $user->delete();
        return redirect()->action('AdminsUsersController@index')->with('status', 'ลบสมาชิกสำเร็จ');
    }
}