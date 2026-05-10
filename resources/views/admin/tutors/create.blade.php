@extends('admin.layout')
@section('title', 'Tambah Guru Privat')
@section('page-title', 'Tambah Guru Privat')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="admin-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-user-plus me-2"></i>Form Guru Privat Baru</span>
                <a href="{{ route('admin.tutors.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
            </div>
            <div class="card-body p-4">
                @if($guruUsers->isEmpty())
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Tidak ada user dengan role <strong>Guru</strong> yang belum memiliki profil. 
                    <a href="{{ route('admin.users.create') }}">Tambah user guru baru</a> terlebih dahulu.
                </div>
                @else
                <form action="{{ route('admin.tutors.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        {{-- User selection --}}
                        <div class="col-md-6">
                            <label class="form-label">Pilih User (Role Guru) <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                <option value="">— Pilih Guru —</option>
                                @foreach($guruUsers as $guru)
                                <option value="{{ $guru->id }}" {{ old('user_id')==$guru->id?'selected':'' }}>{{ $guru->name }} ({{ $guru->email }})</option>
                                @endforeach
                            </select>
                            @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Subjects --}}
                        <div class="col-md-6">
                            <label class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                            <input type="text" name="subjects" class="form-control @error('subjects') is-invalid @enderror" value="{{ old('subjects') }}" placeholder="Matematika, Fisika, Bahasa Inggris" required>
                            <small class="text-muted">Pisahkan dengan koma</small>
                            @error('subjects')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Location --}}
                        <div class="col-md-4">
                            <label class="form-label">Kota <span class="text-danger">*</span></label>
                            <input type="text" name="location_city" class="form-control @error('location_city') is-invalid @enderror" value="{{ old('location_city') }}" placeholder="Jakarta Selatan" required>
                            @error('location_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Area / Kecamatan</label>
                            <input type="text" name="location_area" class="form-control" value="{{ old('location_area') }}" placeholder="Kebayoran Baru">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Pengalaman (thn) <span class="text-danger">*</span></label>
                            <input type="number" name="experience_years" class="form-control" value="{{ old('experience_years', 0) }}" min="0" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Pendidikan</label>
                            <input type="text" name="education" class="form-control" value="{{ old('education') }}" placeholder="S1 Pendidikan">
                        </div>

                        {{-- Bio --}}
                        <div class="col-12">
                            <label class="form-label">Bio / Deskripsi</label>
                            <textarea name="bio" class="form-control" rows="3" placeholder="Deskripsi pengalaman mengajar, metode, dll.">{{ old('bio') }}</textarea>
                        </div>
                    </div>

                    {{-- Rates --}}
                    <hr>
                    <h6 class="fw-bold mb-3"><i class="fas fa-money-bill-wave me-2"></i>Tarif per Durasi</h6>
                    <div class="row g-3">
                        @foreach([30, 60, 90, 120] as $idx => $dur)
                        <div class="col-md-3">
                            <label class="form-label">{{ $dur }} Menit</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Rp</span>
                                <input type="hidden" name="rates[{{ $idx }}][duration]" value="{{ $dur }}">
                                <input type="number" name="rates[{{ $idx }}][price]" class="form-control" value="{{ old("rates.{$idx}.price", 0) }}" min="0" placeholder="0">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <small class="text-muted">Set harga 0 atau kosongkan untuk durasi yang tidak tersedia.</small>

                    {{-- Schedule --}}
                    <hr>
                    <h6 class="fw-bold mb-3"><i class="fas fa-calendar-alt me-2"></i>Jadwal Ketersediaan</h6>
                    @php $days = ['senin'=>'Senin','selasa'=>'Selasa','rabu'=>'Rabu','kamis'=>'Kamis','jumat'=>'Jumat','sabtu'=>'Sabtu','minggu'=>'Minggu']; @endphp
                    @php $slots = ['pagi'=>'Pagi (08-12)','siang'=>'Siang (12-15)','sore'=>'Sore (15-18)','malam'=>'Malam (18-21)']; @endphp
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered text-center" style="font-size:13px;">
                            <thead class="table-light">
                                <tr>
                                    <th>Hari</th>
                                    @foreach($slots as $sk => $sl) <th>{{ $sl }}</th> @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($days as $dk => $dl)
                                <tr>
                                    <td class="fw-semibold text-start">{{ $dl }}</td>
                                    @foreach($slots as $sk => $sl)
                                    <td>
                                        <input type="checkbox" name="schedule[{{ $dk }}][]" value="{{ $sk }}" class="form-check-input"
                                            {{ in_array($sk, old("schedule.{$dk}", [])) ? 'checked' : '' }}>
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.tutors.index') }}" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>Simpan Guru Privat</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
