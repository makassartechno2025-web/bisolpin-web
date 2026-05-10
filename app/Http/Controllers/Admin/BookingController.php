<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['student', 'tutorProfile.user', 'review']);

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                  ->orWhereHas('student', fn($q2) => $q2->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('tutorProfile.user', fn($q2) => $q2->where('name', 'like', "%{$search}%"));
            });
        }

        $bookings = $query->latest()->paginate(15)->appends($request->query());

        $stats = [
            'total'     => Booking::count(),
            'pending'   => Booking::byStatus('pending')->count(),
            'confirmed' => Booking::byStatus('confirmed')->count(),
            'completed' => Booking::byStatus('completed')->count(),
            'cancelled' => Booking::byStatus('cancelled')->count(),
        ];

        return view('admin.bookings.index', compact('bookings', 'stats'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['student', 'tutorProfile.user', 'review.student']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status'        => 'required|in:confirmed,completed,cancelled',
            'cancel_reason' => 'nullable|string|max:500',
        ]);

        $data = ['status' => $request->status];

        if ($request->status === 'cancelled') {
            $data['cancelled_by'] = 'admin';
            $data['cancel_reason'] = $request->cancel_reason;
        }

        $booking->update($data);

        $labels = [
            'confirmed' => 'dikonfirmasi',
            'completed' => 'diselesaikan',
            'cancelled' => 'dibatalkan',
        ];

        return back()->with('success', "Booking {$booking->booking_code} berhasil {$labels[$request->status]}.");
    }
}
