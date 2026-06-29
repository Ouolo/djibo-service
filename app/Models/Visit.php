<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'page_url',
        'session_id',
        'visited_at'
    ];

    protected $casts = [
        'visited_at' => 'datetime'
    ];
}