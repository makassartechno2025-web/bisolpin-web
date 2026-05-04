@extends('admin.layout')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e8f8f6;">
                <i class="fas fa-graduation-cap" style="color:#1BA89C;"></i>
            </div>
            <div class="stat-number">{{ $stats['courses'] }}</div>
            <div class="stat-label">Total Kursus <span class="text-success ms-1">({{ $stats['published_courses'] }} publik)</span></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff3e0;">
                <i class="fas fa-calendar-alt" style="color:#ff9800;"></i>
            </div>
            <div class="stat-number">{{ $stats['events'] }}</div>
            <div class="stat-label">Total Event <span class="text-success ms-1">({{ $stats['published_events'] }} publik)</span></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e8eaf6;">
                <i class="fas fa-newspaper" style="color:#5c6bc0;"></i>
            </div>
            <div class="stat-number">{{ $stats['articles'] }}</div>
            <div class="stat-label">Total Artikel <span class="text-success ms-1">({{ $stats['published_articles'] }} publik)</span></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fce4ec;">
                <i class="fas fa-star" style="color:#e91e63;"></i>
            </div>
            <div class="stat-number">{{ $stats['testimonials'] }}</div>
            <div class="stat-label">Total Testimoni</div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="admin-card card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="fas fa-bolt me-2" style="color:#FFBF00;"></i>Aksi Cepat</span>
            </div>
            <div class="card-body d-flex flex-wrap gap-2 p-3">
                <a href="{{ route('admin.courses.create') }}" class="btn btn-admin-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Kursus
                </a>
                <a href="{{ route('admin.events.create') }}" class="btn btn-admin-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Event
                </a>
                <a href="{{ route('admin.articles.create') }}" class="btn btn-admin-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tulis Artikel
                </a>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-outline-admin btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Testimoni
                </a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-admin btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Kategori
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Tables -->
<div class="row g-3">
    <!-- Latest Courses -->
    <div class="col-lg-6">
        <div class="admin-card card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-graduation-cap me-2" style="color:#1BA89C;"></i>Kursus Terbaru</span>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-sm btn-outline-admin">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Judul</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($latestCourses as $c)
                        <tr>
                            <td>{{ Str::limit($c->title, 35) }}</td>
                            <td><span class="{{ $c->is_published ? 'badge-published' : 'badge-draft' }}">{{ $c->is_published ? 'Publik' : 'Draft' }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="text-center text-muted py-3">Belum ada kursus</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Latest Events -->
    <div class="col-lg-6">
        <div class="admin-card card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-calendar-alt me-2" style="color:#ff9800;"></i>Event Terbaru</span>
                <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-outline-admin">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Judul</th><th>Tanggal</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($latestEvents as $e)
                        <tr>
                            <td>{{ Str::limit($e->title, 25) }}</td>
                            <td>{{ $e->event_date->format('d M Y') }}</td>
                            <td><span class="{{ $e->is_published ? 'badge-published' : 'badge-draft' }}">{{ $e->is_published ? 'Publik' : 'Draft' }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Belum ada event</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
