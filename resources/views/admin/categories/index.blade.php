@extends('admin.layout')
@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')
@section('content')
<div class="row">
<div class="col-lg-8">
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px;">Total: <strong>{{ $categories->count() }}</strong> kategori</p>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-admin-primary"><i class="fas fa-plus me-2"></i>Tambah Kategori</a>
</div>
<div class="admin-card card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>#</th><th>Nama Kategori</th><th>Tipe</th><th>Kursus</th><th>Artikel</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($categories as $i => $cat)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $cat->name }}</strong></td>
                    <td><span class="badge {{ $cat->type === 'course' ? 'bg-info' : 'bg-secondary' }} text-white">{{ $cat->type === 'course' ? 'Kursus' : 'Blog' }}</span></td>
                    <td>{{ $cat->courses_count ?? 0 }}</td>
                    <td>{{ $cat->articles_count ?? 0 }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-outline-admin me-1"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada kategori</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>
<div class="col-lg-4">
<div class="admin-card card">
    <div class="card-header"><i class="fas fa-plus me-2"></i>Tambah Kategori Cepat</div>
    <div class="card-body p-3">
        <form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST">
            @csrf @if(isset($category)) @method('PUT') @endif
            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $category->name ?? '') }}" placeholder="e.g. Microsoft Office">
            </div>
            <div class="mb-3">
                <label class="form-label">Tipe</label>
                <select name="type" class="form-select" required>
                    <option value="course" {{ old('type', $category->type ?? '') === 'course' ? 'selected' : '' }}>Kursus</option>
                    <option value="blog" {{ old('type', $category->type ?? '') === 'blog' ? 'selected' : '' }}>Blog/Artikel</option>
                </select>
            </div>
            <button type="submit" class="btn btn-admin-primary w-100">
                <i class="fas fa-save me-2"></i>{{ isset($category) ? 'Perbarui' : 'Simpan' }}
            </button>
            @if(isset($category))<a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary w-100 mt-2">Batal</a>@endif
        </form>
    </div>
</div>
</div>
</div>
@endsection
