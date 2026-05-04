@extends('admin.layout')
@section('title', 'Kelola Testimoni')
@section('page-title', 'Kelola Testimoni')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px;">Total: <strong>{{ $testimonials->total() }}</strong> testimoni</p>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-admin-primary"><i class="fas fa-plus me-2"></i>Tambah Testimoni</a>
</div>
<div class="row g-3">
    @forelse($testimonials as $t)
    <div class="col-md-6 col-lg-4">
        <div class="admin-card card h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center gap-3 mb-3">
                    @if($t->avatar_url)
                        <img src="{{ $t->avatar_url }}" style="width:48px;height:48px;border-radius:50%;object-fit:cover;">
                    @else
                        <div style="width:48px;height:48px;border-radius:50%;background:#e8f8f6;display:flex;align-items:center;justify-content:center;font-size:18px;font-weight:700;color:#1BA89C;">{{ strtoupper(substr($t->name,0,1)) }}</div>
                    @endif
                    <div>
                        <div class="fw-600" style="font-size:14px;">{{ $t->name }}</div>
                        <div class="text-muted" style="font-size:12px;">{{ $t->role ?? '' }}</div>
                        <div>@for($i=1;$i<=5;$i++)<i class="fas fa-star" style="font-size:10px;color:{{ $i <= $t->rating ? '#FFBF00' : '#ddd' }};"></i>@endfor</div>
                    </div>
                </div>
                <p style="font-size:13px;color:#555;">"{{ Str::limit($t->content, 100) }}"</p>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="{{ $t->is_published ? 'badge-published' : 'badge-draft' }}">{{ $t->is_published ? 'Publik' : 'Draft' }}</span>
                    <div>
                        <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-sm btn-outline-admin me-1"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus testimoni?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5 text-muted">Belum ada testimoni. <a href="{{ route('admin.testimonials.create') }}">Tambah sekarang</a></div>
    @endforelse
</div>
@if($testimonials->hasPages())<div class="mt-3 d-flex justify-content-center">{{ $testimonials->links() }}</div>@endif
@endsection
