<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'is_read', 'preferred_date', 'preferred_time', 'service_selected', 'consultation_status'];

    protected $casts = [
        'is_read' => 'boolean',
        'preferred_date' => 'date',
    ];
}
