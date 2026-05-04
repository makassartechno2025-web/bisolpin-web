@extends('admin.layout')
@section('title', 'Kelola Event')
@section('page-title', 'Kelola Event')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px;">Total: <strong>{{ $events->total() }}</strong> event</p>
    <a href="{{ route('admin.events.create') }}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>Tambah Event
    </a>
</div>
<div class="admin-card card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>#</th><th>Gambar</th><th>Judul</th><th>Tanggal</th><th>Lokasi</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($events as $i => $event)
                <tr>
                    <td>{{ $events->firstItem() + $i }}</td>
                    <td>
                        @if($event->image_url)
                            <img src="{{ $event->image_url }}" style="width:60px;height:40px;object-fit:cover;border-radius:6px;">
                        @else
                            <div style="width:60px;height:40px;background:#f0f0f0;border-radius:6px;display:flex;align-items:center;justify-content:center;"><i class="fas fa-image text-muted"></i></div>
                        @endif
                    </td>
                    <td><strong>{{ Str::limit($event->title, 40) }}</strong></td>
                    <td>{{ $event->event_date->format('d M Y, H:i') }}</td>
                    <td>{{ $event->location ?? '-' }}</td>
                    <td><span class="{{ $event->is_published ? 'badge-published' : 'badge-draft' }}">{{ $event->is_published ? 'Publik' : 'Draft' }}</span></td>
                    <td>
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline-admin me-1"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus event ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-5 text-muted">Belum ada event. <a href="{{ route('admin.events.create') }}">Tambah sekarang</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($events->hasPages())<div class="card-footer bg-white d-flex justify-content-center">{{ $events->links() }}</div>@endif
</div>
@endsection
