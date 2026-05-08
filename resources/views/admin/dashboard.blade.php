@extends('admin.layout')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stat Cards Row 1 --}}
<div class="row g-3 mb-4">
    <div class="col-md-2 col-sm-4 col-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e8f8f6;">
                <i class="fas fa-graduation-cap" style="color:#1BA89C;"></i>
            </div>
            <div class="stat-number">{{ $stats['courses'] }}</div>
            <div class="stat-label">Kursus <span class="text-success ms-1">({{ $stats['published_courses'] }} publik)</span></div>
        </div>
    </div>
    <div class="col-md-2 col-sm-4 col-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff3e0;">
                <i class="fas fa-calendar-alt" style="color:#ff9800;"></i>
            </div>
            <div class="stat-number">{{ $stats['events'] }}</div>
            <div class="stat-label">Event <span class="text-success ms-1">({{ $stats['published_events'] }} publik)</span></div>
        </div>
    </div>
    <div class="col-md-2 col-sm-4 col-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e8eaf6;">
                <i class="fas fa-newspaper" style="color:#5c6bc0;"></i>
            </div>
            <div class="stat-number">{{ $stats['articles'] }}</div>
            <div class="stat-label">Artikel <span class="text-success ms-1">({{ $stats['published_articles'] }} publik)</span></div>
        </div>
    </div>
    <div class="col-md-2 col-sm-4 col-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fce4ec;">
                <i class="fas fa-star" style="color:#e91e63;"></i>
            </div>
            <div class="stat-number">{{ $stats['testimonials'] }}</div>
            <div class="stat-label">Testimoni</div>
        </div>
    </div>
    <div class="col-md-2 col-sm-4 col-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e3f2fd;">
                <i class="fas fa-users" style="color:#1976d2;"></i>
            </div>
            <div class="stat-number">{{ $stats['users'] }}</div>
            <div class="stat-label">Pengguna <span class="text-muted ms-1">({{ $stats['admin_users'] }} admin)</span></div>
        </div>
    </div>
    <div class="col-md-2 col-sm-4 col-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#f3e5f5;">
                <i class="fas fa-tags" style="color:#8e24aa;"></i>
            </div>
            <div class="stat-number">{{ $stats['categories'] }}</div>
            <div class="stat-label">Kategori</div>
        </div>
    </div>
</div>

{{-- Charts Row --}}
<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="admin-card card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="fas fa-chart-bar me-2" style="color:#1BA89C;"></i>Artikel Diterbitkan (6 Bulan Terakhir)</span>
            </div>
            <div class="card-body p-3">
                <canvas id="articleChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="admin-card card h-100">
            <div class="card-header">
                <span><i class="fas fa-chart-pie me-2" style="color:#ff9800;"></i>Kategori Kursus</span>
            </div>
            <div class="card-body p-3 d-flex align-items-center justify-content-center">
                @if($categoryChart->count())
                    <canvas id="categoryChart" height="180"></canvas>
                @else
                    <p class="text-muted text-center my-4"><i class="fas fa-tags fa-2x mb-2 d-block"></i>Belum ada kategori kursus</p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
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
                <a href="{{ route('admin.faqs.create') }}" class="btn btn-outline-admin btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah FAQ
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

{{-- Recent Tables --}}
<div class="row g-3 mb-3">
    {{-- Latest Courses --}}
    <div class="col-lg-6">
        <div class="admin-card card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-graduation-cap me-2" style="color:#1BA89C;"></i>Kursus Terbaru</span>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-sm btn-outline-admin">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Judul</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                        @forelse($latestCourses as $c)
                        <tr>
                            <td>{{ Str::limit($c->title, 35) }}</td>
                            <td><span class="{{ $c->is_published ? 'badge-published' : 'badge-draft' }}">{{ $c->is_published ? 'Publik' : 'Draft' }}</span></td>
                            <td><a href="{{ route('admin.courses.edit', $c) }}" class="btn btn-sm btn-outline-admin py-0 px-2"><i class="fas fa-edit"></i></a></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Belum ada kursus</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Latest Events --}}
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

<div class="row g-3">
    {{-- Latest Articles --}}
    <div class="col-lg-6">
        <div class="admin-card card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-newspaper me-2" style="color:#5c6bc0;"></i>Artikel Terbaru</span>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-outline-admin">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Judul</th><th>Penulis</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($latestArticles as $a)
                        <tr>
                            <td>{{ Str::limit($a->title, 30) }}</td>
                            <td class="text-muted" style="font-size:12px;">{{ $a->author }}</td>
                            <td><span class="{{ $a->is_published ? 'badge-published' : 'badge-draft' }}">{{ $a->is_published ? 'Publik' : 'Draft' }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Belum ada artikel</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Latest Testimonials --}}
    <div class="col-lg-6">
        <div class="admin-card card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-star me-2" style="color:#e91e63;"></i>Testimoni Terbaru</span>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm btn-outline-admin">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Nama</th><th>Rating</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($latestTestimonials as $t)
                        <tr>
                            <td>
                                @if($t->avatar_url)
                                    <img src="{{ $t->avatar_url }}" style="width:28px;height:28px;border-radius:50%;object-fit:cover;margin-right:6px;">
                                @endif
                                {{ Str::limit($t->name, 20) }}
                            </td>
                            <td>
                                @for($i=1;$i<=5;$i++)
                                    <i class="fas fa-star" style="color:{{ $i<=$t->rating ? '#FFBF00' : '#ddd' }};font-size:11px;"></i>
                                @endfor
                            </td>
                            <td><span class="{{ $t->is_published ? 'badge-published' : 'badge-draft' }}">{{ $t->is_published ? 'Publik' : 'Draft' }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Belum ada testimoni</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Article chart
const articleCtx = document.getElementById('articleChart');
new Chart(articleCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'Artikel Diterbitkan',
            data: {!! json_encode($chartData) !!},
            backgroundColor: 'rgba(27,168,156,0.15)',
            borderColor: '#1BA89C',
            borderWidth: 2,
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f0f0f0' } },
            x: { grid: { display: false } }
        }
    }
});

@if($categoryChart->count())
// Category pie chart
const categoryCtx = document.getElementById('categoryChart');
const palette = ['#1BA89C','#FFBF00','#5c6bc0','#e91e63','#ff9800','#8e24aa','#00bcd4'];
new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($categoryChart->pluck('name')) !!},
        datasets: [{
            data: {!! json_encode($categoryChart->pluck('courses_count')) !!},
            backgroundColor: palette.slice(0, {{ $categoryChart->count() }}),
            borderWidth: 2,
            borderColor: '#fff',
        }]
    },
    options: {
        responsive: true,
        cutout: '65%',
        plugins: { legend: { position: 'bottom', labels: { font: { size: 11 } } } }
    }
});
@endif
</script>
@endsection
