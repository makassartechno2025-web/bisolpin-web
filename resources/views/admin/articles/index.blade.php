@extends('admin.layout')
@section('title', 'Kelola Artikel')
@section('page-title', 'Kelola Artikel / Blog')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px;">Total: <strong>{{ $articles->total() }}</strong> artikel</p>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-admin-primary"><i class="fas fa-plus me-2"></i>Tulis Artikel</a>
</div>
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
                    <td><strong>{{ Str::limit($article->title, 40) }}</strong></td>
                    <td>{{ $article->category->name ?? '-' }}</td>
                    <td>{{ $article->author }}</td>
                    <td>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</td>
                    <td><span class="{{ $article->is_published ? 'badge-published' : 'badge-draft' }}">{{ $article->is_published ? 'Publik' : 'Draft' }}</span></td>
                    <td>
                        <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-outline-admin me-1"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
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
