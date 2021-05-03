<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = ['title', 'slug', 'status'];
}
