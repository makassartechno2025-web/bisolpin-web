<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'event_date',
        'location', 'price', 'is_free', 'image_url',
        'registration_link', 'icon_url', 'is_published',
    ];

    protected $casts = [
        'is_free'      => 'boolean',
        'is_published' => 'boolean',
        'price'        => 'decimal:2',
        'event_date'   => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }
}
