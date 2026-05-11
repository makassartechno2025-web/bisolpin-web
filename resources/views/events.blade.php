@extends('layout.mainlayout')
@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-bar" style="background:linear-gradient(135deg,#1BA89C 0%,#0d7a71 100%);padding:40px 0;">
    <div class="container">
        <div class="breadcrumb-list text-center">
            <h2 class="breadcrumb-title text-white mb-2" style="font-weight:700;">Semua Event</h2>
            <p class="text-white mb-0" style="opacity:0.85;">Ikuti berbagai event dan kegiatan menarik yang kami selenggarakan</p>
        </div>
    </div>
</div>

<section class="page-content" style="padding:60px 0;">
    <div class="container">
        @if($events->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-calendar-alt fa-4x mb-3" style="color:#1BA89C;opacity:0.4;"></i>
            <h5 class="text-muted">Belum ada event yang tersedia</h5>
            <p class="text-muted">Pantau terus halaman ini untuk update kegiatan terbaru dari kami.</p>
            @auth
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.events.create') }}" class="btn btn-sm text-white mt-2"
               style="background:#1BA89C;border-radius:8px;">
                <i class="fas fa-plus me-1"></i>Buat Event
            </a>
            @endif
            @endauth
        </div>
        @else
        <div class="row g-4">
            @foreach($events as $event)
            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm" style="border-radius:14px;overflow:hidden;transition:transform 0.2s;">
                    {{-- Thumbnail --}}
                    <div style="height:180px;overflow:hidden;background:#f0fafa;">
                        @if($event->image_url)
                        <img src="{{ $event->image_url }}" alt="{{ $event->title }}"
                             class="w-100 h-100" style="object-fit:cover;">
                        @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                             style="background:linear-gradient(135deg,#e8f8f6,#d0f0ec);">
                            <i class="fas fa-calendar fa-3x" style="color:#1BA89C;opacity:0.4;"></i>
                        </div>
                        @endif
                    </div>

                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge" style="background:#e8f8f6;color:#1BA89C;">{{ $event->category->name ?? 'Event' }}</span>
                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i>{{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d M Y') : '-' }}</small>
                        </div>
                        <h5 class="card-title mt-2 fw-bold"><a href="#" class="text-dark">{{ $event->title }}</a></h5>
                        <p class="text-muted small mt-2">{{ Str::limit(strip_tags($event->description), 100) }}</p>
                    </div>

                    <div class="card-footer bg-white border-0 px-4 pb-4 pt-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted small">
                            <i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $event->location ?? 'Online' }}
                        </span>
                        <a href="#" style="font-size:13px;font-weight:600;color:#1BA89C;" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

@endsection
