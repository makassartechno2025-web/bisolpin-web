@extends('admin.layout')
@section('title', 'Kelola User')
@section('page-title', 'Kelola User')

@section('content')
{{-- Stats Cards --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3 col-xl">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e8f8f6;color:#1BA89C;"><i class="fas fa-users"></i></div>
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Total User</div>
        </div>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff3cd;color:#856404;"><i class="fas fa-user-shield"></i></div>
            <div class="stat-number">{{ $stats['admin'] }}</div>
            <div class="stat-label">Admin</div>
        </div>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <div class="stat-card">
            <div class="stat-icon" style="background:#d1ecf1;color:#0c5460;"><i class="fas fa-chalkboard-teacher"></i></div>
            <div class="stat-number">{{ $stats['guru'] }}</div>
            <div class="stat-label">Guru</div>
        </div>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e2e3ff;color:#4e5dbd;"><i class="fas fa-user-graduate"></i></div>
            <div class="stat-number">{{ $stats['siswa'] }}</div>
            <div class="stat-label">Siswa</div>
        </div>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <div class="stat-card">
            <div class="stat-icon" style="background:#d4edda;color:#155724;"><i class="fas fa-check-circle"></i></div>
            <div class="stat-number">{{ $stats['active'] }}</div>
            <div class="stat-label">Aktif</div>
        </div>
    </div>
</div>

{{-- Filters + Actions --}}
<div class="admin-card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span><i class="fas fa-filter me-1"></i>Filter & Cari</span>
        <a href="{{ route('admin.users.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Tambah User
        </a>
    </div>
    <div class="card-body p-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select form-select-sm">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ request('role')=='admin'?'selected':'' }}>Admin</option>
                    <option value="guru" {{ request('role')=='guru'?'selected':'' }}>Guru</option>
                    <option value="siswa" {{ request('role')=='siswa'?'selected':'' }}>Siswa</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status')=='active'?'selected':'' }}>Aktif</option>
                    <option value="suspended" {{ request('status')=='suspended'?'selected':'' }}>Suspended</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Cari</label>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Nama atau email..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button class="btn btn-admin-primary btn-sm flex-fill"><i class="fas fa-search"></i></button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-times"></i></a>
            </div>
        </form>
    </div>
</div>

{{-- Users Table --}}
<div class="admin-card">
    <div class="card-header">
        <i class="fas fa-users me-2"></i>Daftar User ({{ $users->total() }})
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Telepon</th>
                    <th>Bergabung</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $i => $user)
                <tr>
                    <td class="text-muted">{{ $users->firstItem() + $i }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:32px;height:32px;background:{{ $user->role==='admin'?'#fff3cd':($user->role==='guru'?'#d1ecf1':'#e2e3ff') }};font-size:12px;font-weight:600;color:#333;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-semibold" style="font-size:13px;">{{ $user->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:13px;">{{ $user->email }}</td>
                    <td>
                        @php
                            $roleBg = ['admin'=>'#fff3cd','guru'=>'#d1ecf1','siswa'=>'#e2e3ff'];
                            $roleColor = ['admin'=>'#856404','guru'=>'#0c5460','siswa'=>'#4e5dbd'];
                        @endphp
                        <span class="badge" style="background:{{ $roleBg[$user->role] ?? '#eee' }};color:{{ $roleColor[$user->role] ?? '#333' }};font-size:11px;border-radius:20px;padding:3px 10px;">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>
                        @if($user->status === 'active')
                            <span class="badge bg-success" style="font-size:11px;border-radius:20px;padding:3px 10px;">Aktif</span>
                        @elseif($user->status === 'suspended')
                            <span class="badge bg-danger" style="font-size:11px;border-radius:20px;padding:3px 10px;">Suspended</span>
                        @else
                            <span class="badge bg-warning text-dark" style="font-size:11px;border-radius:20px;padding:3px 10px;">Pending</span>
                        @endif
                    </td>
                    <td style="font-size:13px;">{{ $user->phone ?? '-' }}</td>
                    <td style="font-size:12px;color:#888;">{{ $user->created_at?->format('d M Y') ?? '-' }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-admin btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}" class="d-inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $user->status==='active'?'btn-outline-warning':'btn-outline-success' }}" title="{{ $user->status==='active'?'Suspend':'Aktifkan' }}">
                                    <i class="fas {{ $user->status==='active'?'fa-ban':'fa-check' }}"></i>
                                </button>
                            </form>
                            <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ route('admin.users.destroy', $user) }}', '{{ $user->name }}')" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">
                        <i class="fas fa-inbox fa-2x d-block mb-2"></i>Belum ada user.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="card-body border-top">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
