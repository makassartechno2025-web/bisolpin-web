@extends('admin.layout')
@section('title', 'Guru Privat')
@section('page-title', 'Kelola Guru Privat')

@section('content')
{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#d1ecf1;color:#0c5460;"><i class="fas fa-chalkboard-teacher"></i></div>
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Total Guru Privat</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#d4edda;color:#155724;"><i class="fas fa-check-circle"></i></div>
            <div class="stat-number">{{ $stats['available'] }}</div>
            <div class="stat-label">Tersedia</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff3cd;color:#856404;"><i class="fas fa-star"></i></div>
            <div class="stat-number">{{ $stats['avg_rating'] }}</div>
            <div class="stat-label">Rating Rata-rata</div>
        </div>
    </div>
</div>

{{-- Filters --}}
<div class="admin-card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span><i class="fas fa-filter me-1"></i>Filter</span>
        <a href="{{ route('admin.tutors.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Tambah Guru Privat
        </a>
    </div>
    <div class="card-body p-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Kota</label>
                <select name="city" class="form-select form-select-sm">
                    <option value="">Semua Kota</option>
                    @foreach($cities as $city)
                    <option value="{{ $city }}" {{ request('city')==$city?'selected':'' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Mata Pelajaran</label>
                <input type="text" name="subject" class="form-control form-control-sm" placeholder="cth: Matematika" value="{{ request('subject') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="available" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    <option value="1" {{ request('available')==='1'?'selected':'' }}>Tersedia</option>
                    <option value="0" {{ request('available')==='0'?'selected':'' }}>Tidak Tersedia</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Cari Nama</label>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Nama guru..." value="{{ request('search') }}">
            </div>
            <div class="col-md-1 d-flex gap-1">
                <button class="btn btn-admin-primary btn-sm flex-fill"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    <div class="card-header"><i class="fas fa-chalkboard-teacher me-2"></i>Daftar Guru Privat ({{ $tutors->total() }})</div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Guru</th>
                    <th>Mata Pelajaran</th>
                    <th>Lokasi</th>
                    <th>Rating</th>
                    <th>Tarif Mulai</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tutors as $i => $tutor)
                <tr>
                    <td class="text-muted">{{ $tutors->firstItem() + $i }}</td>
                    <td>
                        <div class="fw-semibold" style="font-size:13px;">{{ $tutor->user->name ?? '—' }}</div>
                        <small class="text-muted">{{ $tutor->experience_years }} thn pengalaman</small>
                    </td>
                    <td>
                        @foreach(($tutor->subjects ?? []) as $subj)
                        <span class="badge bg-light text-dark" style="font-size:11px;">{{ $subj }}</span>
                        @endforeach
                    </td>
                    <td style="font-size:13px;">{{ $tutor->location_city }}{{ $tutor->location_area ? ', '.$tutor->location_area : '' }}</td>
                    <td>
                        <span style="color:#f5a623;font-weight:600;">★ {{ number_format($tutor->rating_avg, 1) }}</span>
                        <small class="text-muted">({{ $tutor->total_reviews }})</small>
                    </td>
                    <td style="font-size:13px;font-weight:600;color:#1BA89C;">
                        @if($tutor->rates->count())
                            Rp {{ number_format($tutor->rates->min('price'), 0, ',', '.') }}
                        @else
                            —
                        @endif
                    </td>
                    <td>
                        @if($tutor->is_available)
                            <span class="badge bg-success" style="font-size:11px;border-radius:20px;padding:3px 10px;">Tersedia</span>
                        @else
                            <span class="badge bg-secondary" style="font-size:11px;border-radius:20px;padding:3px 10px;">Tidak Tersedia</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('admin.tutors.edit', $tutor) }}" class="btn btn-outline-admin btn-sm"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('admin.tutors.toggle-availability', $tutor) }}" class="d-inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $tutor->is_available?'btn-outline-warning':'btn-outline-success' }}" title="{{ $tutor->is_available?'Nonaktifkan':'Aktifkan' }}">
                                    <i class="fas {{ $tutor->is_available?'fa-eye-slash':'fa-eye' }}"></i>
                                </button>
                            </form>
                            <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ route('admin.tutors.destroy', $tutor) }}', '{{ $tutor->user->name ?? 'Guru' }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">
                        <i class="fas fa-inbox fa-2x d-block mb-2"></i>Belum ada guru privat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($tutors->hasPages())
    <div class="card-body border-top">{{ $tutors->links() }}</div>
    @endif
</div>
@endsection
