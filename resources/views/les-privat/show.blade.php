@extends('layout.mainlayout')
@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-bar" style="background:linear-gradient(135deg,#1BA89C 0%,#0d7a71 100%);padding:40px 0;">
    <div class="container">
        <div class="breadcrumb-list text-center">
            <h2 class="breadcrumb-title text-white mb-2" style="font-weight:700;">Profil Guru Privat</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('les-privat') }}" class="text-white" style="opacity:0.8;">Les Privat</a></li>
                    <li class="breadcrumb-item active text-white">{{ $tutor->user->name ?? '—' }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="page-content" style="padding:40px 0;">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row">
            {{-- Main Profile --}}
            <div class="col-lg-8 mb-4">
                {{-- Profile Header --}}
                <div class="card shadow-sm border-0 mb-4" style="border-radius:12px;overflow:hidden;">
                    <div style="background:linear-gradient(135deg,#1BA89C,#0d7a71);padding:24px;color:#fff;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:64px;height:64px;background:rgba(255,255,255,0.2);font-size:26px;font-weight:700;">
                                {{ strtoupper(substr($tutor->user->name ?? '?', 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="mb-1 text-white fw-bold">{{ $tutor->user->name ?? '—' }}</h4>
                                <p class="mb-0" style="opacity:0.85;">{{ $tutor->education ?? 'Guru Privat' }} · {{ $tutor->experience_years }} tahun pengalaman</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap gap-3 mb-3">
                            <span style="font-size:14px;"><i class="fas fa-map-marker-alt me-1" style="color:#1BA89C;"></i>{{ $tutor->location_city }}{{ $tutor->location_area ? ', '.$tutor->location_area : '' }}</span>
                            <span style="font-size:14px;"><i class="fas fa-star me-1 text-warning"></i>{{ number_format($tutor->rating_avg, 1) }} ({{ $tutor->total_reviews }} review)</span>
                            <span class="badge {{ $tutor->is_available ? 'bg-success' : 'bg-secondary' }}" style="font-size:12px;">{{ $tutor->is_available ? 'Tersedia' : 'Tidak Tersedia' }}</span>
                        </div>

                        {{-- Subjects --}}
                        <h6 class="fw-bold mb-2">Mata Pelajaran</h6>
                        <div class="mb-3">
                            @foreach($tutor->subjects ?? [] as $subj)
                            <span class="badge me-1 mb-1" style="background:#e8f8f6;color:#1BA89C;font-size:12px;border-radius:20px;padding:5px 14px;">{{ $subj }}</span>
                            @endforeach
                        </div>

                        @if($tutor->bio)
                        <h6 class="fw-bold mb-2">Tentang</h6>
                        <p style="font-size:14px;color:#555;line-height:1.7;">{{ $tutor->bio }}</p>
                        @endif
                    </div>
                </div>

                {{-- Schedule --}}
                @if($tutor->schedule && count($tutor->schedule))
                <div class="card shadow-sm border-0 mb-4" style="border-radius:12px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3"><i class="fas fa-calendar-alt me-2" style="color:#1BA89C;"></i>Jadwal Ketersediaan</h6>
                        @php
                            $days = ['senin'=>'Senin','selasa'=>'Selasa','rabu'=>'Rabu','kamis'=>'Kamis','jumat'=>'Jumat','sabtu'=>'Sabtu','minggu'=>'Minggu'];
                            $slotLabels = ['pagi'=>'Pagi','siang'=>'Siang','sore'=>'Sore','malam'=>'Malam'];
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-sm text-center" style="font-size:13px;">
                                <thead>
                                    <tr><th></th>@foreach($slotLabels as $sl)<th>{{ $sl }}</th>@endforeach</tr>
                                </thead>
                                <tbody>
                                    @foreach($days as $dk => $dl)
                                    <tr>
                                        <td class="fw-semibold text-start">{{ $dl }}</td>
                                        @foreach($slotLabels as $sk => $sl)
                                        <td>
                                            @if(in_array($sk, $tutor->schedule[$dk] ?? []))
                                            <i class="fas fa-check-circle" style="color:#1BA89C;"></i>
                                            @else
                                            <i class="fas fa-minus text-muted" style="opacity:0.3;"></i>
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Reviews --}}
                <div class="card shadow-sm border-0" style="border-radius:12px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3"><i class="fas fa-star me-2 text-warning"></i>Review ({{ $tutor->total_reviews }})</h6>

                        @forelse($tutor->reviews->where('is_published', true)->take(10) as $review)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div>
                                    <strong style="font-size:14px;">{{ $review->student->name ?? 'Anonim' }}</strong>
                                    <span class="ms-2">
                                        @for($s=1;$s<=5;$s++)
                                        <i class="fas fa-star {{ $s <= $review->rating ? 'text-warning' : 'text-muted' }}" style="font-size:12px;"></i>
                                        @endfor
                                    </span>
                                </div>
                                <small class="text-muted">{{ $review->created_at?->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0" style="font-size:13px;color:#555;">{{ $review->comment ?? '—' }}</p>
                        </div>
                        @empty
                        <p class="text-muted text-center py-3">Belum ada review</p>
                        @endforelse

                        {{-- Review Form --}}
                        @if($canReview)
                        <hr>
                        <h6 class="fw-bold mb-3">Tulis Review</h6>
                        <form method="POST" action="{{ url('les-privat/review') }}">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $reviewableBooking->id }}">
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:13px;">Rating</label>
                                <div class="d-flex gap-2" id="ratingStars">
                                    @for($s=1;$s<=5;$s++)
                                    <label style="cursor:pointer;">
                                        <input type="radio" name="rating" value="{{ $s }}" class="d-none" required>
                                        <i class="fas fa-star text-muted" style="font-size:24px;transition:color 0.2s;" data-star="{{ $s }}"></i>
                                    </label>
                                    @endfor
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:13px;">Komentar</label>
                                <textarea name="comment" class="form-control" rows="3" placeholder="Bagikan pengalaman belajar Anda..." style="border-radius:8px;"></textarea>
                            </div>
                            <button class="btn text-white" style="background:#1BA89C;border-radius:8px;font-weight:600;">
                                <i class="fas fa-paper-plane me-1"></i>Kirim Review
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Sidebar: Rates + Booking --}}
            <div class="col-lg-4">
                {{-- Rates Card --}}
                <div class="card shadow-sm border-0 mb-4" style="border-radius:12px;position:sticky;top:100px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3"><i class="fas fa-money-bill-wave me-2" style="color:#1BA89C;"></i>Tarif</h6>
                        @forelse($tutor->rates->sortBy('duration_minutes') as $rate)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span style="font-size:14px;">{{ $rate->duration_minutes }} menit</span>
                            <span class="fw-bold" style="color:#1BA89C;font-size:16px;">{{ $rate->formatted_price }}</span>
                        </div>
                        @empty
                        <p class="text-muted">Tarif belum tersedia</p>
                        @endforelse

                        @if($tutor->is_available)
                        <hr>
                        <h6 class="fw-bold mb-3">Booking Sekarang</h6>

                        @auth
                        <form method="POST" action="{{ url('les-privat/'.$tutor->id.'/book') }}">
                            @csrf
                            <div class="mb-2">
                                <label class="form-label fw-semibold" style="font-size:12px;">Mata Pelajaran</label>
                                <select name="subject" class="form-select form-select-sm" required style="border-radius:8px;">
                                    @foreach($tutor->subjects ?? [] as $subj)
                                    <option value="{{ $subj }}">{{ $subj }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold" style="font-size:12px;">Durasi</label>
                                <select name="duration_minutes" class="form-select form-select-sm" id="durationSelect" required style="border-radius:8px;">
                                    @foreach($tutor->rates->sortBy('duration_minutes') as $rate)
                                    <option value="{{ $rate->duration_minutes }}" data-price="{{ $rate->price }}">{{ $rate->duration_minutes }} menit — {{ $rate->formatted_price }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold" style="font-size:12px;">Tanggal</label>
                                <input type="date" name="booking_date" class="form-control form-control-sm" required min="{{ date('Y-m-d') }}" style="border-radius:8px;">
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold" style="font-size:12px;">Waktu Mulai</label>
                                <input type="time" name="start_time" class="form-control form-control-sm" style="border-radius:8px;">
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold" style="font-size:12px;">Lokasi</label>
                                <select name="location_type" class="form-select form-select-sm" style="border-radius:8px;">
                                    <option value="offline">Offline (Tatap Muka)</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold" style="font-size:12px;">Alamat (jika offline)</label>
                                <textarea name="location_address" class="form-control form-control-sm" rows="2" style="border-radius:8px;" placeholder="Alamat lengkap..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:12px;">Catatan</label>
                                <textarea name="notes" class="form-control form-control-sm" rows="2" style="border-radius:8px;" placeholder="Opsional..."></textarea>
                            </div>
                            <button class="btn w-100 text-white" style="background:#1BA89C;border-radius:8px;font-weight:600;">
                                <i class="fas fa-calendar-check me-1"></i>Buat Booking
                            </button>
                        </form>
                        @else
                        <a href="{{ url('login') }}" class="btn w-100 text-white" style="background:#1BA89C;border-radius:8px;font-weight:600;">
                            <i class="fas fa-sign-in-alt me-1"></i>Login untuk Booking
                        </a>
                        @endauth
                        @else
                        <div class="alert alert-secondary text-center mt-3" style="font-size:13px;">
                            <i class="fas fa-pause-circle me-1"></i>Guru ini sedang tidak tersedia
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    #ratingStars label:hover i,
    #ratingStars label:hover ~ label i { color: #f5a623 !important; }
    #ratingStars input:checked ~ i { color: #f5a623 !important; }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var stars = document.querySelectorAll('#ratingStars i');
    var radios = document.querySelectorAll('#ratingStars input[type=radio]');
    stars.forEach(function(star) {
        star.addEventListener('click', function() {
            var val = parseInt(this.dataset.star);
            stars.forEach(function(s) {
                s.style.color = parseInt(s.dataset.star) <= val ? '#f5a623' : '#ccc';
            });
        });
    });
});
</script>

@endsection
