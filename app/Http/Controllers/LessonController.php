<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
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
    public function index($id)
    {
        return $id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.lesson.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lessons = new Lesson();
        $lessons->id_topic = $request->id_topic;
        $lessons->lesson_sort = $request->lesson_sort;
        $lessons->lesson_name = $request->lesson_name;
        $lessons->save();
        return redirect("lessonsmanage/$request->id_topic/edit")->with('status', 'เพิ่มบทเรียนสำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editlS($id)
    {
        $lessons = Lesson::findOrFail($id);
        return view('admins.lesson.edit', ['lessons' => $lessons]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lessons = DB::table('topiclessons')
            ->join('lessons', 'topiclessons.id', '=', 'lessons.id_topic')
            ->where('lessons.id_topic', '=', $id)
            ->orderBy('lesson_sort', 'asc')
            ->get();
        $lsID = $id;
        $cname = DB::table('topiclessons')->where('id', '=', $id)->first();
        return view('admins.lesson.index', ['lessons' => $lessons, 'id' => $lsID, 'cname' => $cname]);
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
        $lessons = Lesson::find($id);
        $lessons->lesson_sort = $request->lesson_sort;
        $lessons->lesson_name = $request->lesson_name;
        $lessons->save();
        return redirect("lessonsmanage/$request->id_topic/edit")->with('status', 'แก้ไขบทเรียนสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $lessons = Lesson::find($id);
        $lessons->delete();
        return redirect("lessonsmanage/$request->id_topic/edit")->with('status', 'ลบบทเรียนสำเร็จ');
    }
}