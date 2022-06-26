<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Couses extends Model
{
    protected $table = 'couses';
    protected $fillable = ['id', 'couses_name'];

    public function Courses()
    {
        return $this->hasMany(Couses::class);
    }
}