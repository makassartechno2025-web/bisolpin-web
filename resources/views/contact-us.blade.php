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

        {{-- Contact Info Cards --}}
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="text-center p-4 rounded-3 shadow-sm h-100" style="border:1px solid #e8f8f6;">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                         style="width:60px;height:60px;background:linear-gradient(135deg,#1BA89C,#0d7a71);">
                        <i class="fas fa-map-marker-alt text-white fa-lg"></i>
                    </div>
                    <h6 class="fw-bold mb-1">Alamat</h6>
                    <p class="text-muted mb-0" style="font-size:14px;">
                        {{ $settings['contact_address'] ?? 'Makassar, Sulawesi Selatan' }}
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 rounded-3 shadow-sm h-100" style="border:1px solid #e8f8f6;">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                         style="width:60px;height:60px;background:linear-gradient(135deg,#1BA89C,#0d7a71);">
                        <i class="fas fa-phone-alt text-white fa-lg"></i>
                    </div>
                    <h6 class="fw-bold mb-1">Telepon</h6>
                    <p class="text-muted mb-0" style="font-size:14px;">
                        <a href="tel:{{ $settings['contact_phone'] ?? '' }}" class="text-muted text-decoration-none">
                            {{ $settings['contact_phone'] ?? '+62 xxx xxxx xxxx' }}
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 rounded-3 shadow-sm h-100" style="border:1px solid #e8f8f6;">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                         style="width:60px;height:60px;background:linear-gradient(135deg,#1BA89C,#0d7a71);">
                        <i class="fas fa-envelope text-white fa-lg"></i>
                    </div>
                    <h6 class="fw-bold mb-1">Email</h6>
                    <p class="text-muted mb-0" style="font-size:14px;">
                        <a href="mailto:{{ $settings['contact_email'] ?? '' }}" class="text-muted text-decoration-none">
                            {{ $settings['contact_email'] ?? 'info@bisolpin.com' }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Contact Form --}}
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm" style="border-radius:16px;overflow:hidden;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            {{-- Left: decorative panel --}}
                            <div class="col-md-4 d-none d-md-flex flex-column justify-content-center align-items-center p-4"
                                 style="background:linear-gradient(160deg,#1BA89C,#0d7a71);">
                                <i class="fas fa-paper-plane fa-3x text-white mb-3" style="opacity:0.8;"></i>
                                <h5 class="text-white fw-bold text-center">Kirim Pesan</h5>
                                <p class="text-white text-center mb-4" style="font-size:13px;opacity:0.85;">
                                    Kami siap membantu Anda. Isi form dan kami akan merespons dalam 1×24 jam.
                                </p>
                                {{-- Social links --}}
                                <div class="d-flex gap-3 mt-2">
                                    @if(!empty($settings['social_facebook']))
                                    <a href="{{ $settings['social_facebook'] }}" target="_blank"
                                       class="d-flex align-items-center justify-content-center rounded-circle"
                                       style="width:36px;height:36px;background:rgba(255,255,255,0.2);color:#fff;">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    @endif
                                    @if(!empty($settings['social_instagram']))
                                    <a href="{{ $settings['social_instagram'] }}" target="_blank"
                                       class="d-flex align-items-center justify-content-center rounded-circle"
                                       style="width:36px;height:36px;background:rgba(255,255,255,0.2);color:#fff;">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    @endif
                                    @if(!empty($settings['social_youtube']))
                                    <a href="{{ $settings['social_youtube'] }}" target="_blank"
                                       class="d-flex align-items-center justify-content-center rounded-circle"
                                       style="width:36px;height:36px;background:rgba(255,255,255,0.2);color:#fff;">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>

                            {{-- Right: form --}}
                            <div class="col-md-8 p-4 p-lg-5">
                                <h5 class="fw-bold mb-4">Hubungi Kami</h5>
                                <form action="{{ route('contact.store') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="font-size:13px;">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                   value="{{ old('name') }}" placeholder="Nama Anda" style="border-radius:10px;" required>
                                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="font-size:13px;">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                                   value="{{ old('email') }}" placeholder="email@contoh.com" style="border-radius:10px;" required>
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="font-size:13px;">Nomor HP</label>
                                            <input type="text" name="phone" class="form-control"
                                                   value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" style="border-radius:10px;">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" style="font-size:13px;">Subjek</label>
                                            <input type="text" name="subject" class="form-control"
                                                   value="{{ old('subject') }}" placeholder="Topik pesan" style="border-radius:10px;">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold" style="font-size:13px;">Pesan <span class="text-danger">*</span></label>
                                            <textarea name="message" class="form-control @error('message') is-invalid @enderror"
                                                      rows="5" placeholder="Tuliskan pesan Anda di sini..."
                                                      style="border-radius:10px;" required>{{ old('message') }}</textarea>
                                            @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn w-100 text-white fw-bold"
                                                    style="background:linear-gradient(135deg,#1BA89C,#0d7a71);border-radius:10px;padding:12px;">
                                                <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection