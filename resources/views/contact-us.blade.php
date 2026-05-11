@extends('layout.mainlayout')
@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-bar" style="background:linear-gradient(135deg,#1BA89C 0%,#0d7a71 100%);padding:40px 0;">
    <div class="container">
        <div class="breadcrumb-list text-center">
            <h2 class="breadcrumb-title text-white mb-2" style="font-weight:700;">Kontak Kami</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white" style="opacity:0.8;">Beranda</a></li>
                    <li class="breadcrumb-item active text-white">Kontak</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="page-content" style="padding:60px 0;">
    <div class="container">

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="text-center mb-5">
            <h3 class="fw-bold text-success mb-2">Hubungi Kami</h3>
            <p class="text-muted">Kami selalu siap membantu Anda melalui saluran berikut ini.</p>
        </div>

        {{-- Green Contact Cards --}}
        <div class="row g-4 justify-content-center mb-5">
            <div class="col-md-4">
                <div class="card h-100 border-0 text-center text-white" style="background:#1BA89C; border-radius:16px;">
                    <div class="card-body p-4">
                        <i class="fas fa-map-marker-alt fa-2x mb-3 text-white-50"></i>
                        <h6 class="fw-bold mb-2">Alamat</h6>
                        <p class="mb-0 small opacity-75">JL. M.H. Thamrin No. 20 8,<br>Gondangdia, Menteng, Jakarta Pusat,<br>Tower Lippo Thamrin</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 text-center text-white" style="background:#1BA89C; border-radius:16px;">
                    <div class="card-body p-4">
                        <i class="fas fa-envelope fa-2x mb-3 text-white-50"></i>
                        <h6 class="fw-bold mb-2">Email</h6>
                        <p class="mb-0 small"><a href="mailto:info@bisolpin.com" class="text-white text-decoration-none opacity-75">info@bisolpin.com</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 text-center text-white" style="background:#1BA89C; border-radius:16px;">
                    <div class="card-body p-4">
                        <i class="fab fa-whatsapp fa-2x mb-3 text-white-50"></i>
                        <h6 class="fw-bold mb-2">WhatsApp</h6>
                        <p class="mb-0 small"><a href="https://wa.me/62895322534471" class="text-white text-decoration-none opacity-75">0895 3225 34471</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 text-center text-white" style="background:#1BA89C; border-radius:16px;">
                    <div class="card-body p-4">
                        <i class="fab fa-instagram fa-2x mb-3 text-white-50"></i>
                        <h6 class="fw-bold mb-2">Instagram</h6>
                        <p class="mb-0 small"><a href="https://instagram.com/bisolpin" class="text-white text-decoration-none opacity-75">@bisolpin</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 text-center text-white" style="background:#1BA89C; border-radius:16px;">
                    <div class="card-body p-4">
                        <i class="fab fa-facebook-f fa-2x mb-3 text-white-50"></i>
                        <h6 class="fw-bold mb-2">Facebook</h6>
                        <p class="mb-0 small"><a href="https://facebook.com/bisolpin" class="text-white text-decoration-none opacity-75">fb.me/bisolpin</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 text-center text-white" style="background:#1BA89C; border-radius:16px;">
                    <div class="card-body p-4">
                        <i class="fab fa-tiktok fa-2x mb-3 text-white-50"></i>
                        <h6 class="fw-bold mb-2">TikTok</h6>
                        <p class="mb-0 small"><a href="https://tiktok.com/@bisolpin" class="text-white text-decoration-none opacity-75">@bisolpin</a></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection