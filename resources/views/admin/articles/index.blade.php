@extends('admin.layout')
@section('title', 'Kelola Artikel')
@section('page-title', 'Kelola Artikel / Blog')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <p class="text-muted mb-0" style="font-size:13px;">Total: <strong>{{ $articles->total() }}</strong> artikel</p>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-admin-primary"><i class="fas fa-plus me-2"></i>Tulis Artikel</a>
</div>

{{-- Filter bar --}}
<form method="GET" action="{{ route('admin.articles.index') }}" class="admin-card card mb-3">
    <div class="card-body p-3 d-flex flex-wrap gap-2 align-items-center">
        <div class="flex-grow-1">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Cari judul artikel..." value="{{ request('search') }}">
            </div>
        </div>
        <select name="status" class="form-select form-select-sm" style="width:auto;">
            <option value="">Semua Status</option>
            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Publik</option>
            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
        <button type="submit" class="btn btn-admin-primary btn-sm">Filter</button>
        @if(request('search') || request('status'))
        <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
        @endif
    </div>
</form>

<div class="admin-card card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>#</th><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Penulis</th><th>Tgl Publish</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($articles as $i => $article)
                <tr>
                    <td>{{ $articles->firstItem() + $i }}</td>
                    <td>
                        @if($article->image_url)
                            <img src="{{ $article->image_url }}" style="width:60px;height:40px;object-fit:cover;border-radius:6px;">
                        @else
                            <div style="width:60px;height:40px;background:#f0f0f0;border-radius:6px;display:flex;align-items:center;justify-content:center;"><i class="fas fa-image text-muted"></i></div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ Str::limit($article->title, 40) }}</strong>
                        @if($article->excerpt)
                        <div class="text-muted" style="font-size:11px;">{{ Str::limit($article->excerpt, 60) }}</div>
                        @endif
                    </td>
                    <td>{{ $article->category->name ?? '-' }}</td>
                    <td>{{ $article->author }}</td>
                    <td>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</td>
                    <td><span class="{{ $article->is_published ? 'badge-published' : 'badge-draft' }}">{{ $article->is_published ? 'Publik' : 'Draft' }}</span></td>
                    <td>
                        <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-outline-admin me-1"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-sm btn-outline-danger"
                                onclick="confirmDelete('{{ route('admin.articles.destroy', $article) }}', '{{ addslashes($article->title) }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-5 text-muted">Belum ada artikel. <a href="{{ route('admin.articles.create') }}">Tulis sekarang</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($articles->hasPages())<div class="card-footer bg-white d-flex justify-content-center">{{ $articles->links() }}</div>@endif
</div>
@endsection
