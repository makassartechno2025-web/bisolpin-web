@extends('admin.layout')
@section('title', 'Booking Les Privat')
@section('page-title', 'Kelola Booking')

@section('content')
{{-- Stats --}}
<div class="row g-3 mb-4">
    @php $statItems = [
        ['label'=>'Total','icon'=>'fa-list','bg'=>'#e8f8f6','color'=>'#1BA89C','val'=>$stats['total']],
        ['label'=>'Pending','icon'=>'fa-clock','bg'=>'#fff3cd','color'=>'#856404','val'=>$stats['pending']],
        ['label'=>'Dikonfirmasi','icon'=>'fa-check','bg'=>'#d1ecf1','color'=>'#0c5460','val'=>$stats['confirmed']],
        ['label'=>'Selesai','icon'=>'fa-check-double','bg'=>'#d4edda','color'=>'#155724','val'=>$stats['completed']],
        ['label'=>'Dibatalkan','icon'=>'fa-times','bg'=>'#f8d7da','color'=>'#721c24','val'=>$stats['cancelled']],
    ]; @endphp
    @foreach($statItems as $si)
    <div class="col">
        <div class="stat-card">
            <div class="stat-icon" style="background:{{ $si['bg'] }};color:{{ $si['color'] }};"><i class="fas {{ $si['icon'] }}"></i></div>
            <div class="stat-number">{{ $si['val'] }}</div>
            <div class="stat-label">{{ $si['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- Filter --}}
<div class="admin-card mb-4">
    <div class="card-body p-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                    <option value="confirmed" {{ request('status')=='confirmed'?'selected':'' }}>Dikonfirmasi</option>
                    <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Selesai</option>
                    <option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>Dibatalkan</option>
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label">Cari</label>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Kode booking, nama siswa/guru..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button class="btn btn-admin-primary btn-sm w-100"><i class="fas fa-search me-1"></i>Cari</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary btn-sm w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    <div class="card-header"><i class="fas fa-calendar-check me-2"></i>Daftar Booking ({{ $bookings->total() }})</div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Siswa</th>
                    <th>Guru</th>
                    <th>Mapel</th>
                    <th>Durasi</th>
                    <th>Tanggal</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td><code style="font-size:12px;">{{ $booking->booking_code }}</code></td>
                    <td style="font-size:13px;">{{ $booking->student->name ?? '—' }}</td>
                    <td style="font-size:13px;">{{ $booking->tutorProfile->user->name ?? '—' }}</td>
                    <td style="font-size:13px;">{{ $booking->subject }}</td>
                    <td style="font-size:13px;">{{ $booking->duration_minutes }} mnt</td>
                    <td style="font-size:12px;">{{ $booking->booking_date->format('d M Y') }}</td>
                    <td style="font-size:13px;font-weight:600;">{{ $booking->formatted_price }}</td>
                    <td>{!! $booking->status_badge !!}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-outline-admin btn-sm"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center py-4 text-muted"><i class="fas fa-inbox fa-2x d-block mb-2"></i>Belum ada booking.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($bookings->hasPages())
    <div class="card-body border-top">{{ $bookings->links() }}</div>
    @endif
</div>
@endsection
