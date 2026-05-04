<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'role', 'content', 'avatar_url', 'rating', 'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'rating'       => 'integer',
    ];
}
