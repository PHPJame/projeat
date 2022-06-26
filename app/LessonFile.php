<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonFile extends Model
{
    protected $table = 'lessonfiles';
    protected $fillable = ['id', 'lesson_id', 'id_topic ', 'files_name', 'files_path', 'created_at', 'updated_at'];

    public function Lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
    public function Topic()
    {
        return $this->belongsTo(Topic::class, 'id_topic');
    }
}