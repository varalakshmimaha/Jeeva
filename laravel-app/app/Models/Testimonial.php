<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'role', 'message', 'image', 'rating', 'published', 'order'];

    protected $casts = [
        'published' => 'boolean',
        'rating' => 'integer',
    ];
}
