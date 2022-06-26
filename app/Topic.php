<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topiclessons';
    protected $fillable = ['id', 'id_users', 'couses_id', 'topic_name', 'topic_images', 'topic_videos', 'topic_detail',  'viewer', 'publish',  'created_at', 'updated_at'];

    public function Couses()
    {
        return $this->belongsTo(Couses::class, 'couses_id'); //กําหนด FK ด้วย
    }

    public function AdminsUsers()
    {
        return $this->belongsTo(AdminsUsers::class, 'id_users');
    }
}