@extends('admin.layout')
@section('title', isset($course) ? 'Edit Kursus' : 'Tambah Kursus')
@section('page-title', isset($course) ? 'Edit Kursus' : 'Tambah Kursus')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header">
                <i class="fas fa-graduation-cap me-2" style="color:#1BA89C;"></i>
                {{ isset($course) ? 'Edit Kursus: ' . Str::limit($course->title, 40) : 'Tambah Kursus Baru' }}
            </div>
            <div class="card-body p-4">
                <form action="{{ isset($course) ? route('admin.courses.update', $course) : route('admin.courses.store') }}"
                      method="POST">
                    @csrf
                    @if(isset($course)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Judul Kursus <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required
                               value="{{ old('title', $course->title ?? '') }}"
                               placeholder="e.g. Kursus Microsoft Excel Lengkap">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-select">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $course->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Level <span class="text-danger">*</span></label>
                            <select name="level" class="form-select" required>
                                <option value="pemula" {{ old('level', $course->level ?? '') == 'pemula' ? 'selected' : '' }}>Pemula</option>
                                <option value="menengah" {{ old('level', $course->level ?? '') == 'menengah' ? 'selected' : '' }}>Menengah</option>
                                <option value="mahir" {{ old('level', $course->level ?? '') == 'mahir' ? 'selected' : '' }}>Mahir</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Instruktur</label>
                            <input type="text" name="instructor" class="form-control"
                                   value="{{ old('instructor', $course->instructor ?? '') }}"
                                   placeholder="Nama instruktur">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Durasi</label>
                            <input type="text" name="duration" class="form-control"
                                   value="{{ old('duration', $course->duration ?? '') }}"
                                   placeholder="e.g. 12 Jam">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4"
                                  placeholder="Deskripsi singkat kursus...">{{ old('description', $course->description ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            URL Gambar (Cloudinary)
                            <a href="https://cloudinary.com" target="_blank" class="ms-1" style="font-size:11px;">
                                <i class="fas fa-external-link-alt"></i> Upload di Cloudinary
                            </a>
                        </label>
                        <input type="url" name="image_url" class="form-control" id="imageUrl"
                               value="{{ old('image_url', $course->image_url ?? '') }}"
                               placeholder="https://res.cloudinary.com/..."
                               oninput="previewImage(this.value)">
                        <div class="mt-2">
                            <img id="imgPreview" src="{{ old('image_url', $course->image_url ?? '') }}"
                                 class="img-preview" style="display:{{ (isset($course) && $course->image_url) ? 'block' : 'none' }};">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_free" id="is_free" value="1"
                                    {{ old('is_free', $course->is_free ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_free">Gratis (Tanpa Biaya)</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1"
                                    {{ old('is_published', $course->is_published ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_published">Publikasikan (tampil di website)</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="fas fa-save me-2"></i>{{ isset($course) ? 'Perbarui Kursus' : 'Simpan Kursus' }}
                        </button>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card card">
            <div class="card-header"><i class="fas fa-info-circle me-2"></i>Panduan Upload Gambar</div>
            <div class="card-body p-3" style="font-size:13px;">
                <ol class="ps-3 mb-0">
                    <li class="mb-2">Buka <a href="https://cloudinary.com" target="_blank">cloudinary.com</a> dan login</li>
                    <li class="mb-2">Klik <strong>Media Library → Upload</strong></li>
                    <li class="mb-2">Pilih gambar dari komputer Anda</li>
                    <li class="mb-2">Setelah upload, klik gambar → salin URL</li>
                    <li>Tempel URL ke kolom "URL Gambar" di sebelah kiri</li>
                </ol>
                <div class="mt-3 p-2 rounded" style="background:#f0faf9;font-size:12px;">
                    <i class="fas fa-lightbulb me-1" style="color:#1BA89C;"></i>
                    <strong>Tips:</strong> Gunakan gambar rasio 16:9 untuk tampilan terbaik
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function previewImage(url) {
    const img = document.getElementById('imgPreview');
    if (url) { img.src = url; img.style.display = 'block'; }
    else { img.style.display = 'none'; }
}
</script>
@endsection
