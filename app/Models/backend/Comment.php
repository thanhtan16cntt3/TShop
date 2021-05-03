<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'post_comments';
    protected $guarded = [];

    public function post(){
        return $this->belongsTo('App\Models\backend\Post');
    }

    public function author(){
        return $this->hasOne('App\User','id','user_id');
    }
}
