<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorReview extends Model
{
    protected $fillable = [
        'booking_id', 'student_id', 'tutor_profile_id',
        'rating', 'comment', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    // ── Auto-recalculate tutor rating after save ──────────

    protected static function booted(): void
    {
        static::saved(function (TutorReview $review) {
            $review->tutorProfile->recalculateRating();
        });

        static::deleted(function (TutorReview $review) {
            $review->tutorProfile->recalculateRating();
        });
    }

    // ── Relations ─────────────────────────────────────────

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function tutorProfile()
    {
        return $this->belongsTo(TutorProfile::class);
    }
}
