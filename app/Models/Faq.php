<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'category',
        'order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'order'        => 'integer',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('order')->orderBy('id');
    }
}
