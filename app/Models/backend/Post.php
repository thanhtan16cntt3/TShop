<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'summary', 'quote', 'description', 'category_id', 'photo', 'status', 'added_by'
    ];

    public function postCategory(){
        return $this->hasOne('App\Models\backend\PostCategory', 'id', 'category_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\backend\Tag', 'post_tag', 'post_id', 'tag_id');
    }

    public function author(){
        return $this->hasOne('App\User', 'id', 'added_by');
    }
}
