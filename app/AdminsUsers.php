<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminsUsers extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'id', 'name', 'email', 'password', 'id_role',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'id_role');
    }

    public function Courses()
    {
        return $this->hasMany(Courses::class, 'id');
    }
}