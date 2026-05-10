<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorRate extends Model
{
    protected $fillable = [
        'tutor_profile_id', 'duration_minutes', 'price',
    ];

    public function tutorProfile()
    {
        return $this->belongsTo(TutorProfile::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
