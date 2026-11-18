<?php

namespace App\Models;

use App\Support\Seo;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'meta_title', 'meta_description', 'subtitle', 'description', 'content', 'benefits', 'packages', 'icon', 'order'];

    protected $casts = [
        'packages' => 'array',
    ];

    /** Meta title for the service page: the one set in admin, else "<title> | Jiva Birth & Beyond". */
    public function seoTitle(): string
    {
        return trim((string) $this->meta_title) !== '' ? trim($this->meta_title) : Seo::title($this->title);
    }

    /** Meta description: the one set in admin, else a summary of the service description. */
    public function seoDescription(): string
    {
        $custom = trim((string) $this->meta_description);

        return $custom !== '' ? $custom : Seo::excerpt($this->description ?: $this->content);
    }
}
