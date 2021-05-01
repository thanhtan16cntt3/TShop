<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = "banners";

    protected $fillable = ['photo', 'description', 'title', 'status', 'slug'];
}
