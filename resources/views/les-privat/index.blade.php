@extends('layout.mainlayout')
@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-bar" style="background:linear-gradient(135deg,#1BA89C 0%,#0d7a71 100%);padding:40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-list text-center">
                    <h2 class="breadcrumb-title text-white mb-2" style="font-weight:700;">Les Privat</h2>
                    <p class="text-white mb-0" style="opacity:0.85;">Temukan guru privat terbaik untuk tingkatkan potensi belajar Anda</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="page-content" style="padding:40px 0;">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row">
            {{-- Filter Sidebar --}}
            <div class="col-lg-3 mb-4">
                <div class="card shadow-sm border-0" style="border-radius:12px;">
                    <div class="card-body p-3">
                        <h6 class="fw-bold mb-3"><i class="fas fa-filter me-2" style="color:#1BA89C;"></i>Filter</h6>
                        <form method="GET" action="{{ route('les-privat') }}">
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:13px;">Mata Pelajaran</label>
                                <input type="text" name="subject" class="form-control form-control-sm" placeholder="cth: Matematika" value="{{ request('subject') }}" style="border-radius:8px;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:13px;">Kota</label>
                                <select name="city" class="form-select form-select-sm" style="border-radius:8px;">
                                    <option value="">Semua Kota</option>
                                    @foreach($cities as $city)
                                    <option value="{{ $city }}" {{ request('city')==$city?'selected':'' }}>{{ $city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:13px;">Rating Minimum</label>
                                <select name="rating" class="form-select form-select-sm" style="border-radius:8px;">
                                    <option value="">Semua</option>
                                    <option value="4" {{ request('rating')=='4'?'selected':'' }}>★ 4+</option>
                                    <option value="3" {{ request('rating')=='3'?'selected':'' }}>★ 3+</option>
                                    <option value="2" {{ request('rating')=='2'?'selected':'' }}>★ 2+</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:13px;">Hari Tersedia</label>
                                <select name="day" class="form-select form-select-sm" style="border-radius:8px;">
                                    <option value="">Semua Hari</option>
                                    @foreach(['senin'=>'Senin','selasa'=>'Selasa','rabu'=>'Rabu','kamis'=>'Kamis','jumat'=>'Jumat','sabtu'=>'Sabtu','minggu'=>'Minggu'] as $dk => $dl)
                                    <option value="{{ $dk }}" {{ request('day')==$dk?'selected':'' }}>{{ $dl }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn w-100 btn-sm text-white" style="background:#1BA89C;border-radius:8px;font-weight:600;">
                                <i class="fas fa-search me-1"></i>Terapkan Filter
                            </button>
                            @if(request()->hasAny(['subject','city','rating','day']))
                            <a href="{{ route('les-privat') }}" class="btn btn-outline-secondary btn-sm w-100 mt-2" style="border-radius:8px;">Reset</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            {{-- Tutor Grid --}}
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="text-muted mb-0" style="font-size:14px;">
                        Menampilkan <strong>{{ $tutors->total() }}</strong> guru privat
                    </p>
                </div>

                @if($tutors->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3 d-block"></i>
                    <h5 class="text-muted">Belum ada guru privat yang tersedia</h5>
                    <p class="text-muted">Coba ubah filter pencarian Anda</p>
                </div>
                @else
                <div class="row g-3">
                    @foreach($tutors as $tutor)
                    <div class="col-md-6 col-xl-4">
                        <div class="card h-100 shadow-sm border-0" style="border-radius:12px;transition:transform 0.2s;overflow:hidden;">
                            {{-- Card Top --}}
                            <div style="background:linear-gradient(135deg,#1BA89C,#0d7a71);padding:16px;color:#fff;position:relative;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;background:rgba(255,255,255,0.2);font-size:18px;font-weight:700;">
                                        {{ strtoupper(substr($tutor->user->name ?? '?', 0, 1)) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-white">{{ $tutor->user->name ?? '—' }}</h6>
                                        <small style="opacity:0.8;">{{ $tutor->education ?? 'Guru Privat' }}</small>
                                    </div>
                                </div>
                                @if($tutor->total_reviews > 0)
                                <div class="position-absolute" style="top:12px;right:12px;">
                                    <span style="background:rgba(255,255,255,0.2);padding:3px 8px;border-radius:20px;font-size:12px;">
                                        ★ {{ number_format($tutor->rating_avg, 1) }}
                                    </span>
                                </div>
                                @endif
                            </div>

                            <div class="card-body p-3">
                                {{-- Subjects --}}
                                <div class="mb-2">
                                    @foreach(array_slice($tutor->subjects ?? [], 0, 3) as $subj)
                                    <span class="badge me-1 mb-1" style="background:#e8f8f6;color:#1BA89C;font-size:11px;border-radius:20px;padding:3px 10px;">{{ $subj }}</span>
                                    @endforeach
                                    @if(count($tutor->subjects ?? []) > 3)
                                    <span class="badge bg-light text-muted" style="font-size:11px;">+{{ count($tutor->subjects) - 3 }}</span>
                                    @endif
                                </div>

                                {{-- Location --}}
                                <p class="mb-2" style="font-size:13px;color:#666;">
                                    <i class="fas fa-map-marker-alt me-1" style="color:#1BA89C;"></i>
                                    {{ $tutor->location_city }}{{ $tutor->location_area ? ', '.$tutor->location_area : '' }}
                                </p>

                                {{-- Experience --}}
                                <p class="mb-2" style="font-size:13px;color:#666;">
                                    <i class="fas fa-briefcase me-1" style="color:#1BA89C;"></i>
                                    {{ $tutor->experience_years }} tahun pengalaman
                                </p>

                                {{-- Price --}}
                                @if($tutor->rates->count())
                                <div class="mb-0" style="font-size:13px;">
                                    <span class="text-muted">Mulai dari</span>
                                    <span class="fw-bold" style="color:#1BA89C;font-size:16px;">
                                        Rp {{ number_format($tutor->rates->min('price'), 0, ',', '.') }}
                                    </span>
                                    <span class="text-muted">/ {{ $tutor->rates->sortBy('price')->first()->duration_minutes ?? 30 }} menit</span>
                                </div>
                                @endif
                            </div>

                            <div class="card-footer bg-white border-0 p-3 pt-0">
                                <a href="{{ route('les-privat.show', $tutor->id) }}" class="btn w-100 btn-sm text-white" style="background:#1BA89C;border-radius:8px;font-weight:600;">
                                    Lihat Profil
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($tutors->hasPages())
                <div class="mt-4">{{ $tutors->links() }}</div>
                @endif
                @endif
            </div>
        </div>
    </div>
</section>

<style>
    .col-md-6 .card:hover, .col-xl-4 .card:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important; }
</style>

@endsection
