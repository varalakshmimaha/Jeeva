<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'category', 'content', 'icon', 'image', 'slug', 'published'];
}
