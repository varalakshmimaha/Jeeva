<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $table = 'gallery_items';
    protected $fillable = ['title', 'description', 'icon', 'color_class', 'order'];
}
