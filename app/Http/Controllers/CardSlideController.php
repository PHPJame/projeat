<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Topic;
use App\Couses;
use App\LessonFiles;
use App\LessonVideo;
use Illuminate\Http\Request;


class CardSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topic = Topic::with('couses')->where('publish', '=', '1')->orderBy('created_at', 'desc')->paginate(6); // จำกัดเปิดดูเฉพาะคอร์สที่เปิด
        return view('index', ['topic' =>  $topic]);
    }

    public function topic_page($id)
    {
        $lessonFile = null;
        $lessonVideo = null;
        $topics_page = Topic::find($id);
        $couses_page_type = $topics_page->couses;
        $lesson = DB::table('topiclessons')
            ->join('lessons', 'topiclessons.id', '=', 'lessons.id_topic')
            ->where('topiclessons.id', '=', $id)
            ->orderBy('lesson_sort', 'asc')
            ->select('lessons.*')
            ->get();
        foreach ($lesson as $les) {
            $lessonFile = DB::table('lessons')
                ->join('lessonfiles', 'lessons.id', '=', 'lessonfiles.lessons_id')
                ->where('lessons.id_couses', '=', $id)
                ->orWhere('lessons.id', '=', $les->id)
                ->select('lessonfiles.*',)
                ->get();
            $lessonVideo = DB::table('lessons')
                ->join('lessonvideo', 'lessons.id', '=', 'lessonvideo.lessons_id')
                ->where('lessons.id_couses', '=', $id)
                ->orWhere('lessons.id', '=', $les->id)
                ->select('lessonvideo.*')
                ->get();
        }

        return view(
            'topic-page',
            [
                'topics_page' => $topics_page,
                'couses_page_type' => $couses_page_type,
                'lesson' => $lesson,
                'lessonFile' =>  $lessonFile,
                'lessonVideo' => $lessonVideo,
            ]
        );
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}