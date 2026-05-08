@extends('admin.layout')
@section('title', 'Kelola FAQ')
@section('page-title', 'Kelola FAQ')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px;">Total: <strong>{{ $faqs->total() }}</strong> FAQ</p>
    <a href="{{ route('admin.faqs.create') }}" class="btn btn-admin-primary"><i class="fas fa-plus me-2"></i>Tambah FAQ</a>
</div>
<div class="admin-card card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>#</th><th>Pertanyaan</th><th>Kategori</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($faqs as $i => $faq)
                <tr>
                    <td>{{ $faqs->firstItem() + $i }}</td>
                    <td>
                        <strong>{{ Str::limit($faq->question, 60) }}</strong>
                        <div class="text-muted" style="font-size:12px;">{{ Str::limit(strip_tags($faq->answer), 80) }}</div>
                    </td>
                    <td>{{ $faq->category ? '<span class="badge bg-light border text-secondary">'.$faq->category.'</span>' : '-' }}</td>
                    <td class="text-center">{{ $faq->order }}</td>
                    <td><span class="{{ $faq->is_published ? 'badge-published' : 'badge-draft' }}">{{ $faq->is_published ? 'Publik' : 'Draft' }}</span></td>
                    <td>
                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-outline-admin me-1"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ route('admin.faqs.destroy', $faq) }}', '{{ addslashes($faq->question) }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-5 text-muted">Belum ada FAQ. <a href="{{ route('admin.faqs.create') }}">Tambah sekarang</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($faqs->hasPages())<div class="card-footer bg-white d-flex justify-content-center">{{ $faqs->links() }}</div>@endif
</div>
@endsection
