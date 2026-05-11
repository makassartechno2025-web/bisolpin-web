@extends('layout.mainlayout')
@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-bar" style="background:linear-gradient(135deg,#1BA89C 0%,#0d7a71 100%);padding:40px 0;">
    <div class="container">
        <div class="breadcrumb-list text-center">
            <h2 class="breadcrumb-title text-white mb-2" style="font-weight:700;">Karier</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white" style="opacity:0.8;">Beranda</a></li>
                    <li class="breadcrumb-item active text-white">Karier</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="page-content" style="padding:60px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Bersama BISOLPIN, Kembangkan Potensimu!</h2>
            <p class="text-muted mx-auto" style="max-width:700px;">
                Kami percaya bahwa setiap individu memiliki potensi untuk menciptakan perubahan. Di BISOLPIN, kamu akan menemukan lingkungan kerja kolaboratif, peluang belajar tanpa batas, dan kesempatan berkarier di dunia pendidikan digital yang sedang berkembang pesat.
            </p>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <h4 class="fw-bold mb-4 border-bottom pb-2">Lowongan yang Tersedia</h4>
                <p class="text-muted">Temukan posisi yang cocok dengan keahlianmu!</p>
            </div>
            
            @php
                $jobs = [
                    'Guru/Mentor Online', 'Pengembang Aplikasi', 'Ahli Bisnis Digital',
                    'Ahli Pengembangan Bisnis', 'Desain Grafis', 'Ahli Pemasaran Digital',
                    'Analis Data', 'Cameramen', 'Video Editor', 'Tim Kreative',
                    'Investor Relationship', 'SPG / SPB'
                ];
            @endphp
            
            @foreach($jobs as $job)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-sm" style="border-radius:12px;">
                    <div class="card-body p-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                             style="width:50px;height:50px;background:#e8f8f6;color:#1BA89C;">
                            <i class="fas fa-briefcase fa-lg"></i>
                        </div>
                        <h5 class="fw-bold mb-2">{{ $job }}</h5>
                        <p class="text-muted small mb-0">Kesempatan untuk berkembang dan berkontribusi dalam dunia pendidikan digital.</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row align-items-center bg-light rounded-4 p-4 p-md-5 mb-5 shadow-sm">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h4 class="fw-bold mb-4">Keuntungan Bergabung dengan BISOLPIN</h4>
                <ul class="list-unstyled mb-0">
                    <li class="mb-3 d-flex align-items-center">
                        <i class="fas fa-check-circle text-success me-3 fs-5"></i> Gaji Kompetitif
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="fas fa-check-circle text-success me-3 fs-5"></i> Kesempatan Belajar & Berkembang
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="fas fa-check-circle text-success me-3 fs-5"></i> Lingkungan Kerja Dinamis
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="fas fa-check-circle text-success me-3 fs-5"></i> Membuat Perbedaan Nyata
                    </li>
                    <li class="mb-0 d-flex align-items-center">
                        <i class="fas fa-check-circle text-success me-3 fs-5"></i> Benefit Lainnya
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ URL::asset('build/img/feature/feature-27.jpg') }}" class="img-fluid rounded-4 shadow" alt="Karier Bisolpin">
            </div>
        </div>

        <div class="text-center bg-white p-5 rounded-4 shadow-sm border" style="border-color:#e8f8f6 !important;">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                 style="width:70px;height:70px;background:linear-gradient(135deg,#1BA89C,#0d7a71);">
                <i class="fas fa-rocket text-white fa-2x"></i>
            </div>
            <h3 class="fw-bold mb-3">Siap Memulai Kariermu?</h3>
            <p class="text-muted mb-4 mx-auto" style="max-width:600px;">
                Kirimkan lamaranmu sekarang dan jadilah bagian dari BISOLPIN! Gunakan subjek: <strong>"Karier BISOLPIN"</strong> dan ceritakan mengapa kamu ingin bergabung.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="mailto:karier@bisolpin.com" class="btn btn-lg text-white" style="background:#1BA89C;border-radius:10px;padding:12px 30px;">
                    <i class="fas fa-envelope me-2"></i> karier@bisolpin.com
                </a>
                <a href="https://wa.me/62895322534471" target="_blank" class="btn btn-lg btn-outline-success" style="border-radius:10px;padding:12px 30px;">
                    <i class="fab fa-whatsapp me-2"></i> 0895-3225-34471
                </a>
            </div>
        </div>

    </div>
</section>

@endsection
