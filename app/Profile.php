<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'roles';
    protected $fillable = ['id', 'role_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function AdminsUsers()
    {
        return $this->hasMany(AdminsUsers::class);
    }
}