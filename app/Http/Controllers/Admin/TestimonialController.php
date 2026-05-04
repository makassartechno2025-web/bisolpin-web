<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:100',
            'role'         => 'nullable|string|max:100',
            'content'      => 'required|string',
            'avatar_url'   => 'nullable|url',
            'rating'       => 'required|integer|min:1|max:5',
            'is_published' => 'boolean',
        ]);
        $validated['is_published'] = $request->boolean('is_published', true);
        Testimonial::create($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:100',
            'role'         => 'nullable|string|max:100',
            'content'      => 'required|string',
            'avatar_url'   => 'nullable|url',
            'rating'       => 'required|integer|min:1|max:5',
            'is_published' => 'boolean',
        ]);
        $validated['is_published'] = $request->boolean('is_published', true);
        $testimonial->update($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus!');
    }

    public function show(Testimonial $testimonial)
    {
        return redirect()->route('admin.testimonials.edit', $testimonial);
    }
}
