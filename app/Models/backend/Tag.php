<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'title', 'slug', 'status'
    ];
}
