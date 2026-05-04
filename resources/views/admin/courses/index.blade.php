@extends('admin.layout')
@section('title', 'Kelola Kursus')
@section('page-title', 'Kelola Kursus')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0" style="font-size:13px;">Total: <strong>{{ $courses->total() }}</strong> kursus</p>
    </div>
    <a href="{{ route('admin.courses.create') }}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>Tambah Kursus
    </a>
</div>

<div class="admin-card card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Thumbnail</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Level</th>
                    <th>Instruktur</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $i => $course)
                <tr>
                    <td>{{ $courses->firstItem() + $i }}</td>
                    <td>
                        @if($course->image_url)
                            <img src="{{ $course->image_url }}" alt="" style="width:60px;height:40px;object-fit:cover;border-radius:6px;">
                        @else
                            <div style="width:60px;height:40px;background:#f0f0f0;border-radius:6px;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-image text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ Str::limit($course->title, 40) }}</strong></td>
                    <td>{{ $course->category->name ?? '-' }}</td>
                    <td><span class="badge bg-light text-dark text-capitalize">{{ $course->level }}</span></td>
                    <td>{{ $course->instructor ?? '-' }}</td>
                    <td>
                        <span class="{{ $course->is_published ? 'badge-published' : 'badge-draft' }}">
                            {{ $course->is_published ? 'Publik' : 'Draft' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-outline-admin me-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus kursus ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="fas fa-graduation-cap fa-2x mb-2 d-block" style="opacity:0.3;"></i>
                        Belum ada kursus. <a href="{{ route('admin.courses.create') }}">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($courses->hasPages())
    <div class="card-footer bg-white d-flex justify-content-center">
        {{ $courses->links() }}
    </div>
    @endif
</div>
@endsection
