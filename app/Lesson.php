<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';
    protected $fillable = ['id', 'id_topic', 'lesson_name', 'lesson_sort', 'created_at', 'updated_at'];
    public function Topic()
    {
        return $this->hasMany(Topic::class, 'id_topic');
    }
}