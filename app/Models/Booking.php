<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_code', 'student_id', 'tutor_profile_id',
        'subject', 'duration_minutes', 'price',
        'booking_date', 'start_time',
        'location_type', 'location_address', 'notes',
        'status', 'cancelled_by', 'cancel_reason',
    ];

    protected function casts(): array
    {
        return [
            'booking_date' => 'date',
        ];
    }

    // ── Auto-generate booking code ────────────────────────

    protected static function booted(): void
    {
        static::creating(function (Booking $booking) {
            if (empty($booking->booking_code)) {
                $booking->booking_code = 'BK-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
            }
        });
    }

    // ── Relations ─────────────────────────────────────────

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function tutorProfile()
    {
        return $this->belongsTo(TutorProfile::class);
    }

    public function review()
    {
        return $this->hasOne(TutorReview::class);
    }

    // ── Scopes ────────────────────────────────────────────

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    // ── Helpers ───────────────────────────────────────────

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending'   => '<span class="badge bg-warning text-dark">Pending</span>',
            'confirmed' => '<span class="badge bg-info">Dikonfirmasi</span>',
            'ongoing'   => '<span class="badge bg-primary">Berlangsung</span>',
            'completed' => '<span class="badge bg-success">Selesai</span>',
            'cancelled' => '<span class="badge bg-danger">Dibatalkan</span>',
            default     => '<span class="badge bg-secondary">' . ucfirst($this->status) . '</span>',
        };
    }
}
