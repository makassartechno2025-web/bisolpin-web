<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'category_id',
        'price', 'is_free', 'image_url', 'instructor',
        'duration', 'level', 'total_students', 'is_published',
    ];

    protected $casts = [
        'is_free'      => 'boolean',
        'is_published' => 'boolean',
        'price'        => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
