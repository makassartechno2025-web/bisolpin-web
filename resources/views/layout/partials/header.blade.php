
{{-- ============================================================
     BISOLPIN HEADER — Unified across all pages
     - No topbar on any page
     - header-one style for all public pages (matches home)
     - header-two style for student/instructor dashboard pages
     - Dynamic auth: dropdown if logged in, Masuk/Daftar if not
     ============================================================ --}}

@php
    $dashboardRoutes = [
        'student-change-password','student-courses','student-dashboard',
        'student-linked-accounts','student-messages','student-notifications',
        'student-profile','student-order-history','student-quiz',
        'student-quiz-questions','student-referral','student-reviews',
        'student-settings','student-social-profile','student-tickets',
        'student-wishlist','student-billing-address','student-certificates',
        'students','student-list','student-details',
        'instructor-announcements','instructor-assignment','instructor-certificate',
        'instructor-change-password','instructor-course','instructor-course-grid',
        'instructor-dashboard','instructor-earnings','instructor-integrations',
        'instructor-linked-accounts','instructor-message','instructor-notifications',
        'instructor-payout','instructor-plans','instructor-profile',
        'instructor-quiz','instructor-quiz-questions','instructor-quiz-results',
        'instructor-settings','instructor-social-profiles','instructor-statements',
        'instructor-tickets','instructor-withdraw',
    ];
    $isDashboard = Route::is($dashboardRoutes);
@endphp

{{-- ── PUBLIC header (header-one, matches home style) ─────── --}}
@if(!$isDashboard)
<header class="header-one">
    <div class="container">
        <div class="header-nav">
            {{-- Mobile hamburger --}}
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon"><i class="isax isax-menu"></i></span>
                </a>
                <div class="navbar-logo">
                    <a class="logo-white header-logo d-flex align-items-center" href="{{ url('/') }}">
                        <div class="bisolpin-logo-icon">
                            <img src="{{ URL::asset('build/img/bisolpin-logo.png') }}" class="logo" alt="Logo" style="max-height:45px;width:auto;">
                        </div>
                        <span class="bisolpin-logo-text">BISOLPIN</span>
                    </a>
                    <a class="logo-dark header-logo d-flex align-items-center" href="{{ url('/') }}">
                        <div class="bisolpin-logo-icon">
                            <img src="{{ URL::asset('build/img/bisolpin-logo.png') }}" class="logo" alt="Logo" style="max-height:45px;width:auto;">
                        </div>
                        <span class="bisolpin-logo-text">BISOLPIN</span>
                    </a>
                </div>
            </div>

            {{-- Main menu wrapper (mobile slide-in) --}}
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="{{ url('/') }}" class="menu-logo d-flex align-items-center">
                        <div class="bisolpin-logo-icon">
                            <img src="{{ URL::asset('build/img/bisolpin-logo.png') }}" class="img-fluid" alt="Logo" style="max-height:45px;width:auto;">
                        </div>
                        <span class="bisolpin-logo-text" style="color:#1BA89C;">BISOLPIN</span>
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);">
                        <i class="fas fa-times"></i>
                    </a>
                </div>

                @include('layout.partials.bisolpin-nav')

                {{-- Mobile auth buttons --}}
                <div class="menu-login">
                    @auth
                    <a href="{{ auth()->user()->role === 'admin' ? url('admin') : (auth()->user()->role === 'guru' ? url('instructor-dashboard') : url('student-dashboard')) }}"
                       class="btn btn-primary w-100 mb-2">
                        <i class="isax isax-user me-2"></i>{{ auth()->user()->name }}
                    </a>
                    <a href="{{ url('signout') }}" class="btn btn-secondary w-100">
                        <i class="isax isax-logout me-2"></i>Keluar
                    </a>
                    @else
                    <a href="{{ url('login') }}" class="btn btn-primary w-100 mb-2">
                        <i class="isax isax-user me-2"></i>Masuk
                    </a>
                    <a href="{{ url('register') }}" class="btn btn-secondary w-100">
                        <i class="isax isax-user-edit me-2"></i>Daftar
                    </a>
                    @endauth
                </div>
            </div>

            {{-- Desktop header right buttons --}}
            <div class="header-btn d-flex align-items-center">
                @auth
                {{-- Logged-in: user avatar dropdown --}}
                <div class="dropdown profile-dropdown">
                    <a href="javascript:void(0);" class="d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex align-items-center gap-2"
                             style="background:#f0faf9;padding:6px 14px;border-radius:50px;border:1.5px solid #1BA89C;cursor:pointer;">
                            <div class="d-flex align-items-center justify-content-center rounded-circle"
                                 style="width:30px;height:30px;background:#1BA89C;color:#fff;font-weight:700;font-size:13px;flex-shrink:0;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span style="font-size:13px;font-weight:600;color:#1BA89C;max-width:120px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">
                                {{ auth()->user()->name }}
                            </span>
                            <i class="fas fa-chevron-down" style="font-size:10px;color:#1BA89C;"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end p-0"
                         style="min-width:220px;border-radius:14px;box-shadow:0 10px 35px rgba(0,0,0,0.12);border:none;overflow:hidden;">
                        {{-- Profile header --}}
                        <div class="px-4 py-3" style="background:linear-gradient(135deg,#1BA89C,#0d7a71);">
                            <div class="d-flex align-items-center gap-2">
                                <div class="d-flex align-items-center justify-content-center rounded-circle"
                                     style="width:38px;height:38px;background:rgba(255,255,255,0.25);color:#fff;font-weight:700;font-size:16px;flex-shrink:0;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-white" style="font-size:13px;line-height:1.3;">{{ auth()->user()->name }}</div>
                                    <div style="font-size:11px;color:rgba(255,255,255,0.75);">{{ ucfirst(auth()->user()->role) }}</div>
                                </div>
                            </div>
                        </div>
                        {{-- Menu items --}}
                        <div class="p-2">
                            @if(auth()->user()->role === 'admin')
                            <a class="dropdown-item rounded d-flex align-items-center py-2 px-3" href="{{ url('admin') }}">
                                <i class="fas fa-tachometer-alt me-2" style="color:#1BA89C;width:16px;"></i>Admin Dashboard
                            </a>
                            @elseif(auth()->user()->role === 'guru')
                            <a class="dropdown-item rounded d-flex align-items-center py-2 px-3" href="{{ url('instructor-dashboard') }}">
                                <i class="fas fa-chalkboard-teacher me-2" style="color:#1BA89C;width:16px;"></i>Dashboard Guru
                            </a>
                            @else
                            <a class="dropdown-item rounded d-flex align-items-center py-2 px-3" href="{{ url('student-dashboard') }}">
                                <i class="fas fa-graduation-cap me-2" style="color:#1BA89C;width:16px;"></i>Dashboard Siswa
                            </a>
                            @endif
                            <a class="dropdown-item rounded d-flex align-items-center py-2 px-3" href="{{ url('student-profile') }}">
                                <i class="fas fa-user me-2" style="color:#1BA89C;width:16px;"></i>Profil Saya
                            </a>
                            <a class="dropdown-item rounded d-flex align-items-center py-2 px-3" href="{{ url('les-privat') }}">
                                <i class="fas fa-book me-2" style="color:#1BA89C;width:16px;"></i>Les Privat
                            </a>
                            <div class="border-top mt-1 pt-1">
                                <a class="dropdown-item rounded d-flex align-items-center py-2 px-3 text-danger" href="{{ url('signout') }}">
                                    <i class="fas fa-sign-out-alt me-2" style="width:16px;"></i>Keluar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                {{-- Not logged in --}}
                <a href="{{ url('login') }}" class="btn btn-primary d-inline-flex align-items-center me-2">
                    <i class="isax isax-user me-2"></i>Masuk
                </a>
                <a href="{{ url('register') }}" class="btn btn-secondary me-0">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</header>
@endif

{{-- ── DASHBOARD header (student/instructor, header-two) ──── --}}
@if($isDashboard)
<!-- Header -->
<header class="header-two">
    <div class="container">
        <div class="header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon"><span></span><span></span><span></span></span>
                </a>
                <div class="navbar-logo">
                    <a class="logo-white header-logo d-flex align-items-center" href="{{ url('/') }}">
                        <img src="{{ URL::asset('build/img/bisolpin-logo.png') }}" class="logo" alt="Logo" style="max-height:45px;width:auto;">
                    </a>
                    <a class="logo-dark header-logo d-flex align-items-center" href="{{ url('/') }}">
                        <img src="{{ URL::asset('build/img/bisolpin-logo.png') }}" class="logo" alt="Logo" style="max-height:45px;width:auto;">
                    </a>
                </div>
            </div>

            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="{{ url('/') }}" class="menu-logo d-flex align-items-center">
                        <img src="{{ URL::asset('build/img/bisolpin-logo.png') }}" class="img-fluid" alt="Logo" style="max-height:45px;width:auto;">
                        <span class="ms-2 fw-bold" style="color:#1BA89C;font-size:16px;">BISOLPIN</span>
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                @include('layout.partials.bisolpin-nav')
            </div>

            <div class="header-btn d-flex align-items-center">
                {{-- Notification --}}
                <div class="icon-btn me-3">
                    <a href="{{ url('cart') }}" class="position-relative">
                        <i class="isax isax-shopping-cart5"></i>
                    </a>
                </div>

                @auth
                {{-- Profile dropdown --}}
                <div class="dropdown profile-dropdown">
                    <a href="javascript:void(0);" class="d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="avatar">
                            <div class="d-flex align-items-center justify-content-center rounded-circle"
                                 style="width:36px;height:36px;background:#1BA89C;color:#fff;font-weight:700;font-size:15px;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <div class="profile-header d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-center rounded-circle me-2"
                                 style="width:40px;height:40px;background:#1BA89C;color:#fff;font-weight:700;font-size:16px;flex-shrink:0;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <h6>{{ auth()->user()->name }}</h6>
                                <p>{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <ul class="profile-body">
                            <li>
                                <a class="dropdown-item d-inline-flex align-items-center rounded fw-medium" href="{{ url('student-profile') }}">
                                    <i class="isax isax-security-user me-2"></i>Profil Saya
                                </a>
                            </li>
                            @if(auth()->user()->role === 'admin')
                            <li>
                                <a class="dropdown-item d-inline-flex align-items-center rounded fw-medium" href="{{ url('admin') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                                </a>
                            </li>
                            @elseif(auth()->user()->role === 'guru')
                            <li>
                                <a class="dropdown-item d-inline-flex align-items-center rounded fw-medium" href="{{ url('instructor-dashboard') }}">
                                    <i class="fas fa-chalkboard-teacher me-2"></i>Dashboard Guru
                                </a>
                            </li>
                            @else
                            <li>
                                <a class="dropdown-item d-inline-flex align-items-center rounded fw-medium" href="{{ url('student-dashboard') }}">
                                    <i class="fas fa-graduation-cap me-2"></i>Dashboard Siswa
                                </a>
                            </li>
                            @endif
                            <li>
                                <a class="dropdown-item d-inline-flex align-items-center rounded fw-medium" href="{{ url('student-order-history') }}">
                                    <i class="isax isax-shopping-cart me-2"></i>Riwayat Booking
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-inline-flex align-items-center rounded fw-medium" href="{{ url('student-settings') }}">
                                    <i class="isax isax-setting-2 me-2"></i>Pengaturan
                                </a>
                            </li>
                        </ul>
                        <div class="profile-footer">
                            <a href="{{ url('signout') }}" class="btn btn-secondary d-inline-flex align-items-center justify-content-center w-100">
                                <i class="isax isax-logout me-2"></i>Keluar
                            </a>
                        </div>
                    </div>
                </div>
                @else
                <a href="{{ url('login') }}" class="btn btn-light d-inline-flex align-items-center me-2">
                    <i class="isax isax-lock-circle me-2"></i>Masuk
                </a>
                <a href="{{ url('register') }}" class="btn btn-secondary me-0">
                    <i class="isax isax-user-edit me-2"></i>Daftar
                </a>
                @endauth
            </div>
        </div>
    </div>
</header>
<!-- /Header -->
@endif
