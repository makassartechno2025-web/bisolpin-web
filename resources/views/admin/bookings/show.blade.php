@extends('admin.layout')
@section('title', 'Detail Booking')
@section('page-title', 'Detail Booking')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="admin-card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-receipt me-2"></i>{{ $booking->booking_code }}</span>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
            </div>
            <div class="card-body p-4">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Informasi Booking</h6>
                        <table class="table table-sm table-borderless" style="font-size:13px;">
                            <tr><td class="text-muted" style="width:130px;">Status</td><td>{!! $booking->status_badge !!}</td></tr>
                            <tr><td class="text-muted">Tanggal</td><td>{{ $booking->booking_date->format('d M Y') }}</td></tr>
                            <tr><td class="text-muted">Waktu</td><td>{{ $booking->start_time ?? '-' }}</td></tr>
                            <tr><td class="text-muted">Mata Pelajaran</td><td>{{ $booking->subject }}</td></tr>
                            <tr><td class="text-muted">Durasi</td><td>{{ $booking->duration_minutes }} menit</td></tr>
                            <tr><td class="text-muted">Harga</td><td class="fw-bold" style="color:#1BA89C;">{{ $booking->formatted_price }}</td></tr>
                            <tr><td class="text-muted">Tipe Lokasi</td><td>{{ ucfirst($booking->location_type) }}</td></tr>
                            @if($booking->location_address)
                            <tr><td class="text-muted">Alamat</td><td>{{ $booking->location_address }}</td></tr>
                            @endif
                            @if($booking->notes)
                            <tr><td class="text-muted">Catatan</td><td>{{ $booking->notes }}</td></tr>
                            @endif
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Pihak Terlibat</h6>
                        <div class="p-3 rounded mb-3" style="background:#f8f9fa;">
                            <small class="text-muted d-block mb-1">Siswa</small>
                            <div class="fw-semibold">{{ $booking->student->name ?? '—' }}</div>
                            <small class="text-muted">{{ $booking->student->email ?? '' }}</small>
                        </div>
                        <div class="p-3 rounded" style="background:#f8f9fa;">
                            <small class="text-muted d-block mb-1">Guru Privat</small>
                            <div class="fw-semibold">{{ $booking->tutorProfile->user->name ?? '—' }}</div>
                            <small class="text-muted">{{ $booking->tutorProfile->user->email ?? '' }}</small>
                        </div>
                    </div>
                </div>

                @if($booking->status === 'cancelled')
                <div class="alert alert-danger" style="font-size:13px;">
                    <i class="fas fa-ban me-1"></i>
                    <strong>Dibatalkan oleh:</strong> {{ ucfirst($booking->cancelled_by ?? '-') }}
                    @if($booking->cancel_reason) — {{ $booking->cancel_reason }} @endif
                </div>
                @endif

                {{-- Review --}}
                @if($booking->review)
                <hr>
                <h6 class="fw-bold mb-3"><i class="fas fa-star me-2 text-warning"></i>Review dari Siswa</h6>
                <div class="p-3 rounded" style="background:#fffbf0;border:1px solid #ffe8a1;">
                    <div class="mb-1">
                        @for($s=1;$s<=5;$s++)
                        <i class="fas fa-star {{ $s <= $booking->review->rating ? 'text-warning' : 'text-muted' }}"></i>
                        @endfor
                        <span class="ms-1 fw-bold">{{ $booking->review->rating }}/5</span>
                    </div>
                    <p class="mb-1" style="font-size:13px;">{{ $booking->review->comment ?? '(Tanpa komentar)' }}</p>
                    <small class="text-muted">{{ $booking->review->created_at?->format('d M Y, H:i') }}</small>
                </div>
                @endif

                {{-- Actions --}}
                @if(in_array($booking->status, ['pending','confirmed','ongoing']))
                <hr>
                <h6 class="fw-bold mb-3"><i class="fas fa-cogs me-2"></i>Ubah Status</h6>
                <div class="d-flex gap-2 flex-wrap">
                    @if($booking->status === 'pending')
                    <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="confirmed">
                        <button class="btn btn-info btn-sm"><i class="fas fa-check me-1"></i>Konfirmasi</button>
                    </form>
                    @endif
                    @if(in_array($booking->status, ['confirmed','ongoing']))
                    <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="completed">
                        <button class="btn btn-success btn-sm"><i class="fas fa-check-double me-1"></i>Tandai Selesai</button>
                    </form>
                    @endif
                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="collapse" data-bs-target="#cancelForm">
                        <i class="fas fa-times me-1"></i>Batalkan
                    </button>
                </div>
                <div class="collapse mt-3" id="cancelForm">
                    <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}" class="p-3 rounded" style="background:#fff5f5;">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="cancelled">
                        <label class="form-label">Alasan pembatalan</label>
                        <textarea name="cancel_reason" class="form-control form-control-sm mb-2" rows="2" placeholder="Opsional"></textarea>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-ban me-1"></i>Konfirmasi Batalkan</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
