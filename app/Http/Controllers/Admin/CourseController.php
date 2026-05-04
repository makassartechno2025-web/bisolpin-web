<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->latest()->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::where('type', 'course')->orderBy('name')->get();
        return view('admin.courses.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'image_url'   => 'nullable|url',
            'instructor'  => 'nullable|string|max:255',
            'duration'    => 'nullable|string|max:100',
            'level'       => 'required|in:pemula,menengah,mahir',
            'is_free'     => 'boolean',
            'is_published'=> 'boolean',
        ]);

        $validated['slug']        = Str::slug($validated['title']);
        $validated['is_free']     = $request->boolean('is_free', true);
        $validated['is_published']= $request->boolean('is_published', false);

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil ditambahkan!');
    }

    public function edit(Course $course)
    {
        $categories = Category::where('type', 'course')->orderBy('name')->get();
        return view('admin.courses.form', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'image_url'   => 'nullable|url',
            'instructor'  => 'nullable|string|max:255',
            'duration'    => 'nullable|string|max:100',
            'level'       => 'required|in:pemula,menengah,mahir',
            'is_free'     => 'boolean',
            'is_published'=> 'boolean',
        ]);

        $validated['is_free']      = $request->boolean('is_free', true);
        $validated['is_published'] = $request->boolean('is_published', false);

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil diperbarui!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil dihapus!');
    }

    public function show(Course $course)
    {
        return redirect()->route('admin.courses.edit', $course);
    }
}
