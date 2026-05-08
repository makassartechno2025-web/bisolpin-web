<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Event;
use App\Models\Article;
use App\Models\Testimonial;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
            'users'              => User::count(),
            'admin_users'        => User::where('role', 'admin')->count(),
        ];

        $latestCourses      = Course::latest()->take(5)->get();
        $latestEvents       = Event::latest()->take(5)->get();
        $latestArticles     = Article::latest()->take(5)->get();
        $latestTestimonials = Testimonial::latest()->take(5)->get();

        // Chart: Articles per month (last 6 months) - SQLite compatible
        $articleChart = Article::select(
                DB::raw("strftime('%Y-%m', created_at) as month_key"),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('month_key')
            ->orderBy('month_key')
            ->get()
            ->map(function ($item) {
                $item->month = \Carbon\Carbon::createFromFormat('Y-m', $item->month_key)->format('M Y');
                return $item;
            });

        $chartLabels = $articleChart->pluck('month')->toArray();
        $chartData   = $articleChart->pluck('total')->toArray();

        // Chart: Category composition for courses - SQLite compatible (no HAVING)
        $categoryChart = Category::where('type', 'course')
            ->withCount('courses')
            ->get()
            ->filter(fn($c) => $c->courses_count > 0)
            ->values();

        return view('admin.dashboard', compact(
            'stats', 'latestCourses', 'latestEvents', 'latestArticles',
            'latestTestimonials', 'chartLabels', 'chartData', 'categoryChart'
        ));
    }
}
