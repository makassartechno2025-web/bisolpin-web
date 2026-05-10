<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TutorProfile;
use App\Models\TutorRate;
use App\Models\User;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    public function index(Request $request)
    {
        $query = TutorProfile::with(['user', 'rates']);

        if ($request->filled('subject')) {
            $query->bySubject($request->subject);
        }
        if ($request->filled('city')) {
            $query->byCity($request->city);
        }
        if ($request->filled('available')) {
            $query->where('is_available', $request->available === '1');
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $tutors = $query->latest()->paginate(15)->appends($request->query());

        // Stats
        $stats = [
            'total'     => TutorProfile::count(),
            'available' => TutorProfile::available()->count(),
            'avg_rating' => round(TutorProfile::avg('rating_avg'), 1),
        ];

        // Distinct cities for filter
        $cities = TutorProfile::distinct()->pluck('location_city')->filter()->sort()->values();

        return view('admin.tutors.index', compact('tutors', 'stats', 'cities'));
    }

    public function create()
    {
        // Users with role 'guru' that don't have a tutor profile yet
        $guruUsers = User::where('role', 'guru')
            ->whereDoesntHave('tutorProfile')
            ->get();

        return view('admin.tutors.create', compact('guruUsers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'          => 'required|exists:users,id',
            'subjects'         => 'required|string',
            'location_city'    => 'required|string|max:100',
            'location_area'    => 'nullable|string|max:100',
            'bio'              => 'nullable|string|max:2000',
            'experience_years' => 'required|integer|min:0',
            'education'        => 'nullable|string|max:255',
            'schedule'         => 'nullable|array',
            'rates'            => 'required|array|min:1',
            'rates.*.duration' => 'required|in:30,60,90,120',
            'rates.*.price'    => 'required|integer|min:0',
        ]);

        // Parse subjects (comma-separated → JSON array)
        $subjects = array_map('trim', explode(',', $request->subjects));

        $tutor = TutorProfile::create([
            'user_id'          => $request->user_id,
            'subjects'         => $subjects,
            'location_city'    => $request->location_city,
            'location_area'    => $request->location_area,
            'bio'              => $request->bio,
            'experience_years' => $request->experience_years,
            'education'        => $request->education,
            'schedule'         => $request->schedule ?? [],
            'is_available'     => true,
        ]);

        // Save rates
        foreach ($request->rates as $rate) {
            if (!empty($rate['price']) && $rate['price'] > 0) {
                $tutor->rates()->create([
                    'duration_minutes' => $rate['duration'],
                    'price'            => $rate['price'],
                ]);
            }
        }

        return redirect()->route('admin.tutors.index')
            ->with('success', 'Profil guru privat berhasil ditambahkan.');
    }

    public function edit(TutorProfile $tutor)
    {
        $tutor->load(['user', 'rates']);
        return view('admin.tutors.edit', compact('tutor'));
    }

    public function update(Request $request, TutorProfile $tutor)
    {
        $request->validate([
            'subjects'         => 'required|string',
            'location_city'    => 'required|string|max:100',
            'location_area'    => 'nullable|string|max:100',
            'bio'              => 'nullable|string|max:2000',
            'experience_years' => 'required|integer|min:0',
            'education'        => 'nullable|string|max:255',
            'schedule'         => 'nullable|array',
            'rates'            => 'required|array|min:1',
            'rates.*.duration' => 'required|in:30,60,90,120',
            'rates.*.price'    => 'required|integer|min:0',
        ]);

        $subjects = array_map('trim', explode(',', $request->subjects));

        $tutor->update([
            'subjects'         => $subjects,
            'location_city'    => $request->location_city,
            'location_area'    => $request->location_area,
            'bio'              => $request->bio,
            'experience_years' => $request->experience_years,
            'education'        => $request->education,
            'schedule'         => $request->schedule ?? [],
        ]);

        // Replace rates
        $tutor->rates()->delete();
        foreach ($request->rates as $rate) {
            if (!empty($rate['price']) && $rate['price'] > 0) {
                $tutor->rates()->create([
                    'duration_minutes' => $rate['duration'],
                    'price'            => $rate['price'],
                ]);
            }
        }

        return redirect()->route('admin.tutors.index')
            ->with('success', 'Profil guru privat berhasil diperbarui.');
    }

    public function destroy(TutorProfile $tutor)
    {
        $tutor->delete();
        return redirect()->route('admin.tutors.index')
            ->with('success', 'Profil guru privat berhasil dihapus.');
    }

    public function toggleAvailability(TutorProfile $tutor)
    {
        $tutor->update(['is_available' => !$tutor->is_available]);
        $label = $tutor->is_available ? 'tersedia' : 'tidak tersedia';
        return back()->with('success', "Guru berhasil ditandai {$label}.");
    }
}
