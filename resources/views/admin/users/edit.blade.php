@extends('admin.layout')
@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-user-edit me-2"></i>Edit: {{ $user->name }}</span>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" minlength="6">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="siswa" {{ old('role', $user->role)=='siswa'?'selected':'' }}>Siswa</option>
                                <option value="guru" {{ old('role', $user->role)=='guru'?'selected':'' }}>Guru</option>
                                <option value="admin" {{ old('role', $user->role)=='admin'?'selected':'' }}>Admin</option>
                            </select>
                            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status', $user->status)=='active'?'selected':'' }}>Aktif</option>
                                <option value="pending" {{ old('status', $user->status)=='pending'?'selected':'' }}>Pending</option>
                                <option value="suspended" {{ old('status', $user->status)=='suspended'?'selected':'' }}>Suspended</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Bio</label>
                            <textarea name="bio" class="form-control" rows="3">{{ old('bio', $user->bio) }}</textarea>
                        </div>
                    </div>

                    {{-- Info panel --}}
                    <div class="mt-3 p-3 rounded" style="background:#f8f9fa;font-size:12px;color:#666;">
                        <i class="fas fa-info-circle me-1"></i>
                        Terdaftar: {{ $user->created_at?->format('d M Y, H:i') ?? '-' }} ·
                        Terakhir update: {{ $user->updated_at?->format('d M Y, H:i') ?? '-' }}
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="fas fa-save me-1"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
