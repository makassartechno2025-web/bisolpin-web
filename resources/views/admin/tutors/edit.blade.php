@extends('admin.layout')
@section('title', 'Edit Guru Privat')
@section('page-title', 'Edit Guru Privat')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="admin-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-user-edit me-2"></i>Edit: {{ $tutor->user->name ?? '—' }}</span>
                <a href="{{ route('admin.tutors.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.tutors.update', $tutor) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Guru</label>
                            <input type="text" class="form-control" value="{{ $tutor->user->name ?? '—' }} ({{ $tutor->user->email ?? '' }})" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                            <input type="text" name="subjects" class="form-control @error('subjects') is-invalid @enderror" value="{{ old('subjects', implode(', ', $tutor->subjects ?? [])) }}" required>
                            <small class="text-muted">Pisahkan dengan koma</small>
                            @error('subjects')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kota <span class="text-danger">*</span></label>
                            <input type="text" name="location_city" class="form-control" value="{{ old('location_city', $tutor->location_city) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Area / Kecamatan</label>
                            <input type="text" name="location_area" class="form-control" value="{{ old('location_area', $tutor->location_area) }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Pengalaman (thn)</label>
                            <input type="number" name="experience_years" class="form-control" value="{{ old('experience_years', $tutor->experience_years) }}" min="0">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Pendidikan</label>
                            <input type="text" name="education" class="form-control" value="{{ old('education', $tutor->education) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Bio / Deskripsi</label>
                            <textarea name="bio" class="form-control" rows="3">{{ old('bio', $tutor->bio) }}</textarea>
                        </div>
                    </div>

                    {{-- Rates --}}
                    <hr>
                    <h6 class="fw-bold mb-3"><i class="fas fa-money-bill-wave me-2"></i>Tarif per Durasi</h6>
                    @php
                        $existingRates = $tutor->rates->keyBy('duration_minutes');
                    @endphp
                    <div class="row g-3">
                        @foreach([30, 60, 90, 120] as $idx => $dur)
                        <div class="col-md-3">
                            <label class="form-label">{{ $dur }} Menit</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Rp</span>
                                <input type="hidden" name="rates[{{ $idx }}][duration]" value="{{ $dur }}">
                                <input type="number" name="rates[{{ $idx }}][price]" class="form-control" value="{{ old("rates.{$idx}.price", $existingRates[$dur]->price ?? 0) }}" min="0">
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Schedule --}}
                    <hr>
                    <h6 class="fw-bold mb-3"><i class="fas fa-calendar-alt me-2"></i>Jadwal Ketersediaan</h6>
                    @php
                        $days = ['senin'=>'Senin','selasa'=>'Selasa','rabu'=>'Rabu','kamis'=>'Kamis','jumat'=>'Jumat','sabtu'=>'Sabtu','minggu'=>'Minggu'];
                        $slots = ['pagi'=>'Pagi (08-12)','siang'=>'Siang (12-15)','sore'=>'Sore (15-18)','malam'=>'Malam (18-21)'];
                        $savedSchedule = old('schedule', $tutor->schedule ?? []);
                    @endphp
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
                                            {{ in_array($sk, $savedSchedule[$dk] ?? []) ? 'checked' : '' }}>
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Info --}}
                    <div class="mt-3 p-3 rounded" style="background:#f8f9fa;font-size:12px;color:#666;">
                        <i class="fas fa-info-circle me-1"></i>
                        Rating: ★ {{ number_format($tutor->rating_avg, 1) }} ({{ $tutor->total_reviews }} review) ·
                        Dibuat: {{ $tutor->created_at?->format('d M Y') }}
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.tutors.index') }}" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
