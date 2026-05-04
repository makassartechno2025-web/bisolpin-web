@extends('admin.layout')
@section('title', isset($testimonial) ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('page-title', isset($testimonial) ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('content')
<div class="row justify-content-center">
<div class="col-lg-7">
<div class="admin-card card">
    <div class="card-header"><i class="fas fa-star me-2" style="color:#FFBF00;"></i>{{ isset($testimonial) ? 'Edit' : 'Tambah' }} Testimoni</div>
    <div class="card-body p-4">
        <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" method="POST">
            @csrf @if(isset($testimonial)) @method('PUT') @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $testimonial->name ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jabatan/Peran</label>
                    <input type="text" name="role" class="form-control" value="{{ old('role', $testimonial->role ?? '') }}" placeholder="e.g. Mahasiswa UI, Guru SMA">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">URL Foto (Cloudinary)</label>
                <input type="url" name="avatar_url" class="form-control" value="{{ old('avatar_url', $testimonial->avatar_url ?? '') }}" placeholder="https://res.cloudinary.com/..." oninput="previewAvatar(this.value)">
                <div class="mt-2">
                    <img id="avatarPreview" src="{{ old('avatar_url', $testimonial->avatar_url ?? '') }}" style="width:64px;height:64px;border-radius:50%;object-fit:cover;display:{{ (isset($testimonial) && $testimonial->avatar_url) ? 'block' : 'none' }};">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Testimoni <span class="text-danger">*</span></label>
                <textarea name="content" class="form-control" rows="4" required placeholder="Pengalaman nyata dari pengguna...">{{ old('content', $testimonial->content ?? '') }}</textarea>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">Rating (1-5)</label>
                    <select name="rating" class="form-select">
                        @for($r=5;$r>=1;$r--)
                        <option value="{{ $r }}" {{ old('rating', $testimonial->rating ?? 5) == $r ? 'selected' : '' }}>
                            {{ $r }} Bintang {{ str_repeat('⭐', $r) }}
                        </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-6 d-flex align-items-end pb-1">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" {{ old('is_published', $testimonial->is_published ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label">Tampilkan di Website</label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-2"></i>Simpan</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
@section('scripts')
<script>function previewAvatar(url){const img=document.getElementById('avatarPreview');if(url){img.src=url;img.style.display='block';}else{img.style.display='none';}}</script>
@endsection
