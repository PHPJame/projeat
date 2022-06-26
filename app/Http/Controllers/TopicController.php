<?php

namespace App\Http\Controllers;


use App\AdminsUsers;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use File;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->id_role == 2) {
            $topicUser = null;
            $topic = Topic::where('id_users', '=', Auth::user()->id)->orderBy('id', 'desc')->get();
            $userProfile = DB::table('users')->where('id', '=', Auth::user()->id)->select('id', 'name')->get();
            return view('admins.topic.index', ['topic' => $topic, 'userProfile' => $userProfile]);
        }
        $topicUser = null;
        $topic = Topic::with('AdminsUsers')->orderBy('id', 'desc')->paginate(7);
        $userProfile = AdminsUsers::select('id', 'name')->get();
        return view('admins.topic.index', ['topic' => $topic, 'userProfile' => $userProfile]);
    }
    public function indexLesson()
    {
        if (Auth::user()->id_role == 2) {
            $topicUser = null;
            $topic = Topic::where('id_users', '=', Auth::user()->id)->orderBy('id', 'desc')->get();
            $userProfile = DB::table('users')->where('id', '=', Auth::user()->id)->select('id', 'name')->get();
            return view('admins.topic.indexlesson', ['topic' => $topic, 'userProfile' => $userProfile]);
        }
        $topicUser = null;
        $topic = Topic::with('AdminsUsers')->orderBy('id', 'desc')->paginate(7);
        $userProfile = AdminsUsers::select('id', 'name')->get();
        return view('admins.topic.indexlesson', ['topic' => $topic, 'userProfile' => $userProfile]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.topic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $topic = new Topic();
        $topic->id_users = Auth::user()->id;
        $topic->viewer = 0;
        $topic->publish = 0; // 0 ปิด /1 เปิด
        $topic->couses_id = $request->couses_id;
        $topic->topic_name = $request->topic_name;
        $cuteVideoLink = Str::substr($request->topic_videos, 17, 50);
        $topic->topic_videos = "https://www.youtube.com/embed/$cuteVideoLink";
        $topic->topic_detail = $request->topic_detail;

        if ($request->hasFile('topic_images')) {
            $filename = Str::random(10) . '.' . $request->file('topic_images')->getClientOriginalExtension();
            $request->file('topic_images')->move(public_path() . '/images/topic/cover/', $filename);
            Image::make(public_path() . '/images/topic/cover/' . $filename)->resize(50, 50)->save(public_path() . '/images//topic/resize/' . $filename);
            $topic->topic_images = $filename;
        } else {
            $topic->topic_images = 'nopic.jpg';
        }
        $topic->save();
        return redirect()->action('TopicController@index')->with('status', 'เพิ่มหัวข้อบทเรียนสำเร็จ');
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
        $topic = Topic::find($id);
        return view('admins.topic.edit', ['topic' => $topic]);
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
        $topic = Topic::find($id);
        $topic->couses_id = $request->couses_id;
        $topic->topic_name = $request->topic_name;
        if ($topic->topic_videos != $request->topic_videos) {
            $cuteVideoLink = Str::substr($request->topic_videos, 17, 50);
            $topic->topic_videos = "https://www.youtube.com/embed/$cuteVideoLink";
        } else {
            $topic->topic_videos = $request->topic_videos;
        }
        $topic->publish = $request->publish;
        $topic->topic_detail = $request->topic_detail;

        if ($request->hasFile('topic_images')) {
            // delete old file before update
            if ($topic->topic_images != 'nopic.jpg') {
                File::delete(public_path() . '\\images\\topic\\cover\\' . $topic->topic_images);
                File::delete(public_path() . '\\images\\topic\\resize\\' . $topic->topic_images);
            }
            $filename = Str::random(10) . '.' . $request->file('topic_images')->getClientOriginalExtension();
            $request->file('topic_images')->move(public_path() . '/images//cover/', $filename);
            Image::make(public_path() . '/images/topic/cover/' . $filename)->resize(50, 50)->save(public_path() . '/images/topic/resize/' .
                $filename);
            $topic->topic_images = $filename;
        }
        $topic->save();
        return redirect()->action('TopicController@index')->with('status', 'แก้ไขหัวข้อบทเรียนสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $topic = Topic::find($id);
        $lesson = DB::table('lessons')->where('id_topic', '=', $id);
        $lesson_file = DB::table('lessonfiles')->where('id_topic', '=', $id);
        $lesson_video = DB::table('lessonvideo')->where('id_topic', '=', $id);

        if ($topic->topic_images != null) {
            if ($topic->topic_images != 'nopic.jpg') {
                File::delete(public_path() . '\\images\\topic\\cover\\' . $topic->topic_images);
            }
        }
        $lesson_file->delete();
        $lesson_video->delete();
        $lesson->delete();
        $topic->delete();

        return redirect("topicmanage")->with('status', 'ลบหัวข้อบทเรียนสำเร็จ');
    }
}