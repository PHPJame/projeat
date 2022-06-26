<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonVideo extends Model
{
    protected $table = 'lessonvideo';
    protected $fillable = ['id', 'lesson_id', 'id_topic ', 'video_name', 'video_path', 'created_at', 'updated_at'];

    public function Lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
    public function Topic()
    {
        return $this->belongsTo(Topic::class, 'id_topic');
    }
}