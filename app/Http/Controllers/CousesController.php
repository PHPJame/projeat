<?php

namespace App\Http\Controllers;

use App\Couses;
use Illuminate\Http\Request;

class CousesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couses = Couses::all();
        return view('admins.couses.index', ['couses' => $couses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.couses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $couses = Couses::where('couses_name', 'LIKE', $request->input('couses_name'))->first();
        if ($couses == NULL) {
            $couses1 = new Couses();
            $couses1->couses_name = $request->input('couses_name');
            $couses1->save();
            return redirect()->action('CousesController@index')->with('add', "เพิ่มรายวิชาสำเร็จ");
        } else {
            return redirect()->action('CousesController@index')->with('faile', "รายวิชานี้อยู่แล้ว");
        }
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
        $couses = Couses::findOrFail($id);
        return view('admins.couses.edit', ['couses' => $couses]);
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
        $couses = Couses::where('couses_name', 'LIKE', $request->input('couses_name'))->first();
        if ($couses == NULL) {
            $couses1 = Couses::find($id);
            $couses1->couses_name = $request->input('couses_name');
            $couses1->save();
            return redirect()->action('CousesController@index')->with('add', "แก้ไขรายวิชาสำเร็จ");
        } else {
            return redirect()->action('CousesController@index')->with('faile', "รายวิชานี้มีอยู่แล้ว");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $couses1 = Couses::find($id);
        $couses1->delete();
        return redirect()->action('CousesController@index')->with('delete', "ลบรายวิชาสำเร็จ");
    }
}