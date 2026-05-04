@extends('admin.layout')
@section('title', isset($category) ? 'Edit Kategori' : 'Tambah Kategori')
@section('page-title', isset($category) ? 'Edit Kategori' : 'Tambah Kategori')
@section('content')
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="admin-card card">
    <div class="card-header"><i class="fas fa-tags me-2"></i>{{ isset($category) ? 'Edit' : 'Tambah' }} Kategori</div>
    <div class="card-body p-4">
        <form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST">
            @csrf @if(isset($category)) @method('PUT') @endif
            <div class="mb-3">
                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $category->name ?? '') }}">
            </div>
            <div class="mb-4">
                <label class="form-label">Tipe <span class="text-danger">*</span></label>
                <select name="type" class="form-select" required>
                    <option value="course" {{ old('type', $category->type ?? '') === 'course' ? 'selected' : '' }}>Kursus</option>
                    <option value="blog" {{ old('type', $category->type ?? '') === 'blog' ? 'selected' : '' }}>Blog/Artikel</option>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-2"></i>Simpan</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
