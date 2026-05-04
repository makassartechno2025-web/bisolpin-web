@extends('admin.layout')
@section('title', 'Pengaturan Website')
@section('page-title', 'Pengaturan Website')
@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST">
@csrf
<div class="row">
<div class="col-lg-8">

    <div class="admin-card card mb-4">
        <div class="card-header"><i class="fas fa-globe me-2"></i>Informasi Website</div>
        <div class="card-body p-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Website</label>
                    <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $settings['site_name'] ?? 'BISOLPIN') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tagline</label>
                    <input type="text" name="site_tagline" class="form-control" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}" placeholder="Sistem Edutech Terpadu">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="site_phone" class="form-control" value="{{ old('site_phone', $settings['site_phone'] ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nomor WhatsApp</label>
                    <input type="text" name="site_whatsapp" class="form-control" value="{{ old('site_whatsapp', $settings['site_whatsapp'] ?? '') }}" placeholder="628123456789">
                    <small class="text-muted">Format: 628xxx (tanpa +, tanpa spasi)</small>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="site_email" class="form-control" value="{{ old('site_email', $settings['site_email'] ?? '') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="site_address" class="form-control" value="{{ old('site_address', $settings['site_address'] ?? '') }}" placeholder="Makassar, Sulawesi Selatan">
            </div>
        </div>
    </div>

    <div class="admin-card card mb-4">
        <div class="card-header"><i class="fas fa-share-alt me-2"></i>Media Sosial</div>
        <div class="card-body p-4">
            <div class="mb-3">
                <label class="form-label"><i class="fab fa-instagram me-2" style="color:#e1306c;"></i>Instagram</label>
                <input type="url" name="social_instagram" class="form-control" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}" placeholder="https://instagram.com/bisolpin">
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fab fa-facebook me-2" style="color:#1877f2;"></i>Facebook</label>
                <input type="url" name="social_facebook" class="form-control" value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}" placeholder="https://facebook.com/bisolpin">
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fab fa-youtube me-2" style="color:#ff0000;"></i>YouTube</label>
                <input type="url" name="social_youtube" class="form-control" value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}" placeholder="https://youtube.com/@bisolpin">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-admin-primary btn-lg">
        <i class="fas fa-save me-2"></i>Simpan Pengaturan
    </button>
</div>
</div>
</form>
@endsection
