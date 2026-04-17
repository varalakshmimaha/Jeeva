<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'role', 'category', 'message', 'image', 'before_image', 'after_image', 'rating', 'published', 'order'];

    protected $casts = [
        'published' => 'boolean',
        'rating' => 'integer',
        'before_image' => 'array',
        'after_image' => 'array',
    ];
}
