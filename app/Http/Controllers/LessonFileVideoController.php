<?php

namespace App\Http\Controllers;

use File;
use App\Topic;
use App\Lessonvideo;
use App\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\LessonFile;


class LessonFileVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('admins.lesson.lessonFileVideo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lessonID = Null;
        if (isset($request->Video_Type)) {
            $lessonVideo = new LessonVideo();
            $lessonVideo->lesson_id = $request->Video_lesson_id;
            $lessonVideo->id_topic = $request->Video_id_topic;
            $lessonVideo->video_name = $request->video_name;
            $cuteVideoLink = Str::substr($request->video_path, 17, 50);
            $lessonVideo->video_path = "https://www.youtube.com/embed/$cuteVideoLink";
            $lessonID = $request->Video_lesson_id;
            $lessonVideo->save();
        }

        if (isset($request->File_Type)) {
            $lessonFile = new LessonFile();
            $lessonFile->lesson_id = $request->File_lesson_id;
            $lessonID = $request->File_lesson_id;
            $lessonFile->id_topic = $request->File_id_topic;
            $lessonFile->files_name = $request->files_name;
            // $lessonsFile->lesson_files_path = $request->lesson_files_path;
            if ($request->file('files_path')->isValid()) {
                $path = $request->files_path->path();
                $extension = $request->files_path->extension();
                $clientOriginalName = $request->files_path->getClientOriginalName();
                $newFileName = time() . $clientOriginalName;
                $uploadedFile = $request->file('files_path');


                // Save File to local drive
                Storage::putFileAs('public/' . $request->topic_name, $uploadedFile, $newFileName);

                //Save File to Photo table

                $lessonFile->files_path = $newFileName;
            }
            $lessonFile->save();
        }

        return redirect("lessonsfilevideo/$lessonID/edit")->with('status', 'เพิ่มเนื้อหาสำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LessonFile  $lessonFile
     * @return \Illuminate\Http\Response
     */
    public function show(LessonFile $lessonFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LessonFile  $lessonFile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lessonName = Lesson::where('id', '=', $id)->first();
        $topicName = Topic::where('id', '=', $lessonName->id_topic)->first();
        $lessonFile = LessonFile::where('lesson_id', '=', $id)->get();
        $lessonVideo = LessonVideo::where('lesson_id', '=', $id)->get();
        return view('admins.lesson.lessonFileVideo.index', ['lessonFile' => $lessonFile, 'lessonVideo' => $lessonVideo, 'lessonName' => $lessonName, 'topicName' => $topicName]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LessonFile  $lessonFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lessonID = Null;
        if (isset($request->Video_Type)) {
            $lessonVideo = LessonVideo::find($id);
            $lessonVideo->video_name = $request->video_name;
            $lessonID = $request->Video_lesson_id;
            if ($lessonVideo->video_path != $request->video_path) {
                $cuteVideoLink = Str::substr($request->video_path, 17, 50);
                $lessonVideo->video_path = "https://www.youtube.com/embed/$cuteVideoLink";
            }
            $lessonVideo->save();
        }
        if (isset($request->File_Type)) {
            $lessonFile = LessonFile::find($id);
            $lessonID = $request->File_lesson_id;
            $lessonFile->files_name = $request->files_name;

            if ($lessonFile->files_path == $request->files_path) {
                $lessonFile->save();
            } else {
                if ($request->file('files_path')) {
                    File::delete(public_path() . '\\storage\\' . $request->topic_name . '/' . $lessonFile->files_path);
                    $path = $request->files_path->path();
                    $extension = $request->files_path->extension();
                    $clientOriginalName = $request->files_path->getClientOriginalName();
                    $newFileName = time() . $clientOriginalName;
                    $uploadedFile = $request->file('files_path');

                    // Save File to local drive
                    Storage::putFileAs('public/' . $request->topic_name, $uploadedFile, $newFileName);

                    //Save File to Photo table

                    $lessonFile->files_path = $newFileName;
                    $lessonFile->save();
                }
            }
            $lessonFile->save();
        }
        return redirect("lessonsfilevideo/$lessonID/edit")->with('status', 'แก้ไขเนื้อหาสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LessonFile  $lessonFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $lessonID = Null;
        if (isset($request->delete_Video)) {
            $lesson_video = LessonVideo::find($id);
            $lessonID = $request->Video_lesson_id;
            $lesson_video->delete();
        }
        if (isset($request->delete_File)) {
            $lesson_file = LessonFile::find($id);
            $lessonID = $request->File_lesson_id;
            if ($lesson_file->_file_path != null) {
                File::delete(public_path() . '\\storage\\' . $request->topic_name . '/' . $lesson_file->files_path);
            }
            $lesson_file->delete();
        }
        return redirect("lessonsfilevideo/$lessonID/edit")->with('status', 'ลบเนื้อหาสำเร็จ');
    }
}