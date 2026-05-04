<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Event;
use App\Models\Article;
use App\Models\Testimonial;
use App\Models\Category;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'courses'       => Course::count(),
            'events'        => Event::count(),
            'articles'      => Article::count(),
            'testimonials'  => Testimonial::count(),
            'categories'    => Category::count(),
            'published_courses'  => Course::where('is_published', true)->count(),
            'published_events'   => Event::where('is_published', true)->count(),
            'published_articles' => Article::where('is_published', true)->count(),
        ];

        $latestCourses   = Course::latest()->take(5)->get();
        $latestEvents    = Event::latest()->take(5)->get();
        $latestArticles  = Article::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestCourses', 'latestEvents', 'latestArticles'));
    }
}
