@extends('admin.layout')
@section('title', isset($article) ? 'Edit Artikel' : 'Tulis Artikel')
@section('page-title', isset($article) ? 'Edit Artikel' : 'Tulis Artikel Baru')

@section('styles')
<style>
    .tox-tinymce { border-radius: 8px !important; border-color: #ddd !important; }
</style>
@endsection

@section('content')
<form action="{{ isset($article) ? route('admin.articles.update', $article) : route('admin.articles.store') }}" method="POST">
@csrf @if(isset($article)) @method('PUT') @endif

<div class="row">
    <!-- Left: Main Content -->
    <div class="col-lg-8">
        <div class="admin-card card mb-3">
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" required style="font-size:16px;font-weight:600;"
                           value="{{ old('title', $article->title ?? '') }}" placeholder="Tulis judul artikel yang menarik...">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ringkasan (Excerpt)</label>
                    <textarea name="excerpt" class="form-control" rows="2" placeholder="Ringkasan singkat artikel (tampil di daftar blog)...">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
                </div>
                <div class="mb-1">
                    <label class="form-label">Konten Artikel <span class="text-danger">*</span></label>
                </div>
                <textarea name="content" id="articleContent">{{ old('content', $article->content ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Right: Sidebar Settings -->
    <div class="col-lg-4">
        <!-- Publish box -->
        <div class="admin-card card mb-3">
            <div class="card-header"><i class="fas fa-cog me-2"></i>Pengaturan Artikel</div>
            <div class="card-body p-3">
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $article->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="author" class="form-control" value="{{ old('author', $article->author ?? 'Tim Bisolpin') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">URL Gambar Cover (Cloudinary)</label>
                    <input type="url" name="image_url" class="form-control" value="{{ old('image_url', $article->image_url ?? '') }}"
                           placeholder="https://res.cloudinary.com/..." oninput="previewImage(this.value)">
                    <img id="imgPreview" src="{{ old('image_url', $article->image_url ?? '') }}" class="img-preview mt-2 w-100"
                         style="display:{{ (isset($article) && $article->image_url) ? 'block' : 'none' }};height:120px;object-fit:cover;">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_published" value="1"
                           {{ old('is_published', $article->is_published ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label">Publikasikan Artikel</label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-admin-primary">
                        <i class="fas fa-save me-2"></i>{{ isset($article) ? 'Perbarui' : 'Simpan' }} Artikel
                    </button>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </div>
        </div>

        <!-- Cloudinary guide -->
        <div class="admin-card card">
            <div class="card-header"><i class="fas fa-cloud-upload-alt me-2"></i>Upload Gambar</div>
            <div class="card-body p-3" style="font-size:12px;">
                <p class="mb-2">Upload gambar ke <a href="https://cloudinary.com" target="_blank">Cloudinary</a>, lalu salin URL-nya ke kolom gambar.</p>
                <p class="mb-0 text-muted">💡 Di dalam editor TinyMCE, Anda bisa langsung tempel URL gambar via Insert → Image.</p>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

@section('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#articleContent',
    height: 500,
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; line-height: 1.8; }',
    language: 'id',
    promotion: false,
    branding: false,
});
function previewImage(url){const img=document.getElementById('imgPreview');if(url){img.src=url;img.style.display='block';}else{img.style.display='none';}}
</script>
@endsection
