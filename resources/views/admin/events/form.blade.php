@extends('admin.layout')
@section('title', isset($event) ? 'Edit Event' : 'Tambah Event')
@section('page-title', isset($event) ? 'Edit Event' : 'Tambah Event')
@section('content')
<div class="row">
<div class="col-lg-8">
<div class="admin-card card">
    <div class="card-header"><i class="fas fa-calendar-alt me-2" style="color:#ff9800;"></i>{{ isset($event) ? 'Edit Event' : 'Tambah Event Baru' }}</div>
    <div class="card-body p-4">
        <form action="{{ isset($event) ? route('admin.events.update', $event) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($event)) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Judul Event <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" required value="{{ old('title', $event->title ?? '') }}" placeholder="e.g. Workshop AI untuk Pendidikan">
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tanggal & Waktu <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="event_date" class="form-control" required
                           value="{{ old('event_date', isset($event) ? $event->event_date->format('Y-m-d\TH:i') : '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location', $event->location ?? '') }}" placeholder="e.g. Aula BISOLPIN / Online via Zoom">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Deskripsi event...">{{ old('description', $event->description ?? '') }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Gambar Banner <span class="text-muted fw-normal">(Cloud)</span></label>
                    <input type="file" name="image" class="form-control" id="imageFile" accept="image/*" onchange="previewFile()">
                    <div class="mt-2"><img id="imgPreview" src="{{ old('image_url', $event->image_url ?? '') }}" class="img-preview" style="display:{{ (isset($event) && $event->image_url) ? 'block' : 'none' }}; max-width: 250px;"></div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Link Pendaftaran</label>
                    <input type="url" name="registration_link" class="form-control" value="{{ old('registration_link', $event->registration_link ?? '') }}" placeholder="https://...">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_free" value="1" {{ old('is_free', $event->is_free ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label">Gratis (Tanpa Biaya)</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" {{ old('is_published', $event->is_published ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label">Publikasikan</label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-2"></i>{{ isset($event) ? 'Perbarui' : 'Simpan' }} Event</button>
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
@section('scripts')
<script>
function previewFile() {
    const preview = document.getElementById('imgPreview');
    const file = document.getElementById('imageFile').files[0];
    const reader = new FileReader();
    reader.addEventListener("load", function () {
        preview.src = reader.result;
        preview.style.display = 'block';
    }, false);
    if (file) { reader.readAsDataURL(file); }
}
</script>
@endsection
