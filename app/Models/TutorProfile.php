<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorProfile extends Model
{
    protected $fillable = [
        'user_id', 'subjects', 'location_city', 'location_area',
        'bio', 'experience_years', 'education', 'photo',
        'rating_avg', 'total_reviews', 'is_available', 'schedule',
    ];

    protected function casts(): array
    {
        return [
            'subjects'     => 'array',
            'schedule'     => 'array',
            'is_available' => 'boolean',
            'rating_avg'   => 'decimal:2',
        ];
    }

    // ── Relations ─────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rates()
    {
        return $this->hasMany(TutorRate::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(TutorReview::class);
    }

    // ── Scopes ────────────────────────────────────────────

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeBySubject($query, string $subject)
    {
        return $query->where('subjects', 'like', "%{$subject}%");
    }

    public function scopeByCity($query, string $city)
    {
        return $query->where('location_city', 'like', "%{$city}%");
    }

    public function scopeMinRating($query, float $rating)
    {
        return $query->where('rating_avg', '>=', $rating);
    }

    // ── Helpers ───────────────────────────────────────────

    public function getMinPriceAttribute()
    {
        return $this->rates->min('price');
    }

    public function recalculateRating(): void
    {
        $reviews = $this->reviews()->where('is_published', true);
        $this->update([
            'rating_avg'    => round($reviews->avg('rating') ?? 0, 2),
            'total_reviews' => $reviews->count(),
        ]);
    }
}
