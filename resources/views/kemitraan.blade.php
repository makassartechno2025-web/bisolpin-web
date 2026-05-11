@extends('layout.mainlayout')
@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-bar" style="background:linear-gradient(135deg,#1BA89C 0%,#0d7a71 100%);padding:40px 0;">
    <div class="container">
        <div class="breadcrumb-list text-center">
            <h2 class="breadcrumb-title text-white mb-2" style="font-weight:700;">Kemitraan</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white" style="opacity:0.8;">Beranda</a></li>
                    <li class="breadcrumb-item active text-white">Kemitraan</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="page-content" style="padding:60px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge mb-3" style="background:#e8f8f6;color:#1BA89C;padding:8px 16px;font-size:14px;border-radius:20px;">
                Membangun Masa Depan Pendidikan Bersama BISOLPIN
            </span>
            <h2 class="fw-bold mb-3">Wujudkan pendidikan yang lebih baik dan menjadi bagian dari perubahan positif bersama kami!</h2>
            <p class="text-muted mx-auto" style="max-width:800px;line-height:1.8;">
                BISOLPIN adalah platform bimbingan belajar digital yang inovatif dan efektif. Kami percaya bahwa kemitraan strategis adalah kunci dalam menciptakan dampak pendidikan yang luas. Mari bersama-sama menghadirkan solusi pendidikan terbaik di Indonesia!
            </p>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ URL::asset('build/img/feature/feature-1.jpg') }}" class="img-fluid rounded-4 shadow-sm" alt="Kemitraan Bisolpin">
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h4 class="fw-bold mb-4">Keuntungan Menjadi Mitra BISOLPIN</h4>
                
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:45px;height:45px;background:#1BA89C;color:white;">
                            <i class="fas fa-globe-asia"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="fw-bold mb-1">Meningkatkan jangkauan & dampak pendidikan</h6>
                        <p class="text-muted small mb-0">Perluas pengaruh positif Anda ke seluruh pelosok negeri melalui platform kami.</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:45px;height:45px;background:#1BA89C;color:white;">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="fw-bold mb-1">Menggunakan teknologi pendidikan inovatif</h6>
                        <p class="text-muted small mb-0">Manfaatkan sistem Edutech terpadu yang praktis, efisien, dan komprehensif.</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:45px;height:45px;background:#1BA89C;color:white;">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="fw-bold mb-1">Kembangkan bisnis & pendapatan</h6>
                        <p class="text-muted small mb-0">Buka peluang baru untuk pertumbuhan instansi atau bisnis Anda di sektor edukasi.</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:45px;height:45px;background:#1BA89C;color:white;">
                            <i class="fas fa-network-wired"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="fw-bold mb-1">Akses ke sumber daya & jaringan luas</h6>
                        <p class="text-muted small mb-0">Terhubung dengan ribuan pelajar, tutor ahli, dan institusi terkemuka lainnya.</p>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:45px;height:45px;background:#1BA89C;color:white;">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="fw-bold mb-1">Buat perbedaan nyata di masyarakat</h6>
                        <p class="text-muted small mb-0">Berkontribusi langsung dalam mencetak generasi penerus bangsa yang unggul.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5 bg-light p-4 p-md-5 rounded-4 border">
            <div class="text-center mb-5">
                <h3 class="fw-bold">Jenis Kemitraan</h3>
                <p class="text-muted">Pilih jalur kolaborasi yang paling sesuai dengan profil Anda.</p>
            </div>
            
            <div class="row g-4">
                @php
                    $partnerships = [
                        ['icon' => 'fa-school', 'title' => 'Kemitraan Sekolah / Kampus'],
                        ['icon' => 'fa-building', 'title' => 'Kemitraan Lembaga Pendidikan'],
                        ['icon' => 'fa-briefcase', 'title' => 'Kemitraan Perusahaan Swasta'],
                        ['icon' => 'fa-landmark', 'title' => 'Kemitraan Instansi Pemerintah / BUMN'],
                        ['icon' => 'fa-user-tie', 'title' => 'Kemitraan Individu'],
                    ];
                @endphp

                @foreach($partnerships as $idx => $partner)
                <div class="col-md-6 col-lg-4 @if($idx == 3) offset-lg-2 @endif">
                    <div class="card h-100 border-0 shadow-sm text-center" style="border-radius:12px;">
                        <div class="card-body p-4">
                            <i class="fas {{ $partner['icon'] }} fa-3x mb-3" style="color:#1BA89C;"></i>
                            <h5 class="fw-bold mb-2">{{ $partner['title'] }}</h5>
                            <p class="text-muted small mb-0">Bersama BISOLPIN, tingkatkan kontribusi nyata untuk pendidikan Indonesia.</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="text-center rounded-4 p-5" style="background:linear-gradient(135deg,#1BA89C,#0d7a71);color:white;">
            <i class="fas fa-seedling fa-3x mb-3 text-warning"></i>
            <h3 class="fw-bold mb-3">Siap Menjadi Mitra BISOLPIN?</h3>
            <p class="mb-4 mx-auto" style="max-width:600px;opacity:0.9;">
                Kirimkan proposal kemitraan Anda sekarang dan jadilah bagian dari transformasi pendidikan Indonesia! Gunakan subjek: <strong>"Kemitraan BISOLPIN"</strong> dan jelaskan bagaimana kita bisa bekerja sama!
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="mailto:kemitraan@bisolpin.com" class="btn btn-lg bg-white text-dark fw-bold" style="border-radius:10px;padding:12px 30px;">
                    <i class="fas fa-envelope me-2 text-primary"></i> kemitraan@bisolpin.com
                </a>
                <a href="https://wa.me/62895322534471" target="_blank" class="btn btn-lg btn-warning fw-bold text-dark" style="border-radius:10px;padding:12px 30px;">
                    <i class="fab fa-whatsapp me-2"></i> 0895-3225-34471
                </a>
            </div>
        </div>

    </div>
</section>

@endsection
