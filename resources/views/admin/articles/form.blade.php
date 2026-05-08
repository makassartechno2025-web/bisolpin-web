@extends('admin.layout')
@section('title', isset($article) ? 'Edit Artikel' : 'Tulis Artikel')
@section('page-title', isset($article) ? 'Edit Artikel' : 'Tulis Artikel Baru')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<style>
    .ql-container { font-size: 14px; min-height: 350px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; }
    .ql-toolbar { border-top-left-radius: 8px; border-top-right-radius: 8px; border-color: #ddd !important; }
    .ql-container.ql-snow { border-color: #ddd !important; }
    .ql-editor { min-height: 350px; line-height: 1.8; }
</style>
@endsection

@section('content')
<form action="{{ isset($article) ? route('admin.articles.update', $article) : route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
@csrf @if(isset($article)) @method('PUT') @endif
<input type="hidden" name="content" id="contentInput">

<div class="row">
    {{-- Left: Main Content --}}
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
                <div id="quillEditor">{!! old('content', $article->content ?? '') !!}</div>
            </div>
        </div>

        {{-- SEO Card --}}
        <div class="admin-card card mb-3">
            <div class="card-header"><i class="fas fa-search me-2"></i>SEO & Meta</div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label">Meta Description <span class="text-muted fw-normal">(maks. 160 karakter)</span></label>
                    <textarea name="meta_description" class="form-control" rows="2" maxlength="160"
                              placeholder="Deskripsi singkat untuk mesin pencari...">{{ old('meta_description', $article->meta_description ?? '') }}</textarea>
                    <small class="text-muted" id="metaCharCount">0/160 karakter</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Right: Sidebar Settings --}}
    <div class="col-lg-4">
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
                    <label class="form-label">Gambar Cover <span class="text-muted fw-normal">(Cloud)</span></label>
                    <input type="file" name="image" class="form-control" id="imageFile" accept="image/*" onchange="previewFile()">
                    <img id="imgPreview" src="{{ old('image_url', $article->image_url ?? '') }}" class="img-preview mt-2 w-100"
                         style="display:{{ (isset($article) && $article->image_url) ? 'block' : 'none' }};height:120px;object-fit:cover;">
                    @if(isset($article) && $article->image_url)
                    <small class="text-muted d-block mt-1">Biarkan kosong untuk mempertahankan gambar saat ini</small>
                    @endif
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
    </div>
</div>
</form>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
// Init Quill
const quill = new Quill('#quillEditor', {
    theme: 'snow',
    modules: {
        toolbar: [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'align': [] }],
            ['link', 'image', 'blockquote', 'code-block'],
            [{ 'color': [] }, { 'background': [] }],
            ['clean']
        ]
    },
    placeholder: 'Mulai tulis konten artikel di sini...',
});

// On form submit, copy Quill HTML to hidden input
document.getElementById('articleForm').addEventListener('submit', function() {
    document.getElementById('contentInput').value = quill.root.innerHTML;
});

// Image preview
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

// Meta description char count
const metaField = document.querySelector('[name="meta_description"]');
const charCount = document.getElementById('metaCharCount');
if (metaField) {
    function updateCount() { charCount.textContent = metaField.value.length + '/160 karakter'; }
    metaField.addEventListener('input', updateCount);
    updateCount();
}
</script>
@endsection
