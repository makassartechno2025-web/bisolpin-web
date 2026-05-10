<?php

namespace App\Http\Controllers;

use App\Models\TutorProfile;
use App\Models\Booking;
use App\Models\TutorReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LesPrivatController extends Controller
{
    /**
     * Public listing of available tutors with filters.
     */
    public function index(Request $request)
    {
        $query = TutorProfile::with(['user', 'rates'])->available();

        if ($request->filled('subject')) {
            $query->bySubject($request->subject);
        }
        if ($request->filled('city')) {
            $query->byCity($request->city);
        }
        if ($request->filled('rating')) {
            $query->minRating((float) $request->rating);
        }
        if ($request->filled('day')) {
            $day = $request->day;
            $query->whereRaw("json_extract(schedule, '$.\"{$day}\"') IS NOT NULL");
        }

        $tutors = $query->orderByDesc('rating_avg')->paginate(12)->appends($request->query());

        $cities = TutorProfile::available()->distinct()->pluck('location_city')->filter()->sort()->values();

        return view('les-privat.index', compact('tutors', 'cities'));
    }

    /**
     * Single tutor profile view.
     */
    public function show($id)
    {
        $tutor = TutorProfile::with(['user', 'rates', 'reviews.student'])->findOrFail($id);

        // Check if logged-in user has a completed booking with this tutor (for review eligibility)
        $canReview = false;
        $reviewableBooking = null;
        if (Auth::check()) {
            $reviewableBooking = Booking::where('student_id', Auth::id())
                ->where('tutor_profile_id', $tutor->id)
                ->where('status', 'completed')
                ->whereDoesntHave('review')
                ->first();
            $canReview = $reviewableBooking !== null;
        }

        return view('les-privat.show', compact('tutor', 'canReview', 'reviewableBooking'));
    }

    /**
     * Store a booking (auth required).
     */
    public function storeBooking(Request $request, $id)
    {
        $request->validate([
            'subject'          => 'required|string|max:100',
            'duration_minutes' => 'required|in:30,60,90,120',
            'booking_date'     => 'required|date|after_or_equal:today',
            'start_time'       => 'nullable|string|max:10',
            'location_type'    => 'required|in:online,offline',
            'location_address' => 'nullable|string|max:500',
            'notes'            => 'nullable|string|max:500',
        ]);

        $tutor = TutorProfile::with('rates')->findOrFail($id);

        // Find matching rate
        $rate = $tutor->rates->where('duration_minutes', $request->duration_minutes)->first();
        $price = $rate ? $rate->price : 0;

        Booking::create([
            'student_id'       => Auth::id(),
            'tutor_profile_id' => $tutor->id,
            'subject'          => $request->subject,
            'duration_minutes' => $request->duration_minutes,
            'price'            => $price,
            'booking_date'     => $request->booking_date,
            'start_time'       => $request->start_time,
            'location_type'    => $request->location_type,
            'location_address' => $request->location_address,
            'notes'            => $request->notes,
            'status'           => 'pending',
        ]);

        return redirect()->route('les-privat.show', $id)
            ->with('success', 'Booking berhasil dibuat! Menunggu konfirmasi.');
    }

    /**
     * Store a review for a completed booking (auth required).
     */
    public function storeReview(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:1000',
        ]);

        $booking = Booking::where('id', $request->booking_id)
            ->where('student_id', Auth::id())
            ->where('status', 'completed')
            ->whereDoesntHave('review')
            ->firstOrFail();

        TutorReview::create([
            'booking_id'       => $booking->id,
            'student_id'       => Auth::id(),
            'tutor_profile_id' => $booking->tutor_profile_id,
            'rating'           => $request->rating,
            'comment'          => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih atas review Anda!');
    }
}
