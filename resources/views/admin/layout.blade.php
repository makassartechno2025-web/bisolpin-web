<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — BISOLPIN</title>
    <link rel="icon" href="{{ URL::asset('build/img/bisolpin-logo.png') }}" type="image/png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #1BA89C;
            --admin-sidebar: #0d1b2a;
            --admin-sidebar-hover: #1BA89C;
            --admin-accent: #1BA89C;
            --admin-yellow: #FFBF00;
        }
        * { font-family: 'Inter', sans-serif; }
        body { background: #f4f6f9; min-height: 100vh; }

        /* Sidebar */
        .admin-sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--admin-sidebar);
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            transition: all 0.3s;
            overflow-y: auto;
        }
        .admin-sidebar .sidebar-brand {
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .admin-sidebar .sidebar-brand img {
            width: 36px;
            clip-path: inset(0 0 25% 0);
        }
        .admin-sidebar .sidebar-brand span {
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .admin-sidebar .sidebar-badge {
            background: var(--admin-accent);
            color: white;
            font-size: 9px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 4px;
            letter-spacing: 0.5px;
        }
        .admin-sidebar .nav-section {
            padding: 16px 12px 4px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.35);
            font-weight: 600;
        }
        .admin-sidebar .nav-link {
            color: rgba(255,255,255,0.65);
            padding: 10px 16px;
            border-radius: 8px;
            margin: 2px 8px;
            font-size: 13.5px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }
        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background: var(--admin-accent);
            color: #fff !important;
        }
        .admin-sidebar .nav-link i {
            width: 18px;
            text-align: center;
            font-size: 14px;
        }

        /* Main content */
        .admin-main {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .admin-topbar h5 { margin: 0; font-weight: 600; font-size: 16px; color: #333; }
        .admin-content { padding: 24px; flex: 1; }

        /* Cards */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px 24px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-card .stat-icon {
            width: 48px; height: 48px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            margin-bottom: 12px;
        }
        .stat-card .stat-number { font-size: 28px; font-weight: 700; color: #1a1a2e; }
        .stat-card .stat-label { font-size: 13px; color: #888; font-weight: 500; }

        /* Table */
        .admin-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border: none;
            overflow: hidden;
        }
        .admin-card .card-header {
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 16px 20px;
            font-weight: 600;
            font-size: 14px;
        }
        .table th { font-size: 12px; text-transform: uppercase; letter-spacing: 0.8px; color: #888; font-weight: 600; }
        .table td { font-size: 13.5px; vertical-align: middle; }
        .badge-published { background: #d4edda; color: #155724; font-size: 11px; border-radius: 20px; padding: 3px 10px; }
        .badge-draft { background: #fff3cd; color: #856404; font-size: 11px; border-radius: 20px; padding: 3px 10px; }

        /* Form */
        .form-label { font-size: 13px; font-weight: 600; color: #555; }
        .form-control, .form-select { font-size: 13.5px; border-radius: 8px; border-color: #ddd; }
        .form-control:focus, .form-select:focus { border-color: var(--admin-accent); box-shadow: 0 0 0 3px rgba(27,168,156,0.15); }

        /* Buttons */
        .btn-admin-primary { background: var(--admin-accent); border-color: var(--admin-accent); color: #fff; font-size: 13px; font-weight: 600; border-radius: 8px; }
        .btn-admin-primary:hover { background: #178a80; border-color: #178a80; color: #fff; }
        .btn-outline-admin { border-color: var(--admin-accent); color: var(--admin-accent); font-size: 13px; border-radius: 8px; }
        .btn-outline-admin:hover { background: var(--admin-accent); color: #fff; }

        /* Image preview */
        .img-preview { max-width: 200px; border-radius: 8px; border: 2px dashed #ddd; }

        /* Toggle switch */
        .form-check-input:checked { background-color: var(--admin-accent); border-color: var(--admin-accent); }

        @media (max-width: 768px) {
            .admin-sidebar { transform: translateX(-260px); }
            body.show-sidebar .admin-sidebar { transform: translateX(0); box-shadow: 2px 0 10px rgba(0,0,0,0.2); }
            .admin-main { margin-left: 0; }
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0; left: 0; width: 100vw; height: 100vh;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }
            body.show-sidebar .sidebar-overlay { display: block; }
        }
    </style>
    @yield('styles')
</head>
<body>

<!-- Overlay for mobile sidebar -->
<div class="sidebar-overlay" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<div class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <img src="{{ URL::asset('build/img/bisolpin-logo.png') }}" alt="Logo">
        <span>BISOLPIN</span>
        <span class="sidebar-badge">ADMIN</span>
    </div>

    <div class="nav-section">Menu Utama</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>

    <div class="nav-section">Konten</div>
    <a href="{{ route('admin.courses.index') }}" class="nav-link {{ Request::is('admin/courses*') ? 'active' : '' }}">
        <i class="fas fa-graduation-cap"></i> Kursus
    </a>
    <a href="{{ route('admin.events.index') }}" class="nav-link {{ Request::is('admin/events*') ? 'active' : '' }}">
        <i class="fas fa-calendar-alt"></i> Event
    </a>
    <a href="{{ route('admin.articles.index') }}" class="nav-link {{ Request::is('admin/articles*') ? 'active' : '' }}">
        <i class="fas fa-newspaper"></i> Artikel / Blog
    </a>
    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}">
        <i class="fas fa-tags"></i> Kategori
    </a>
    <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ Request::is('admin/testimonials*') ? 'active' : '' }}">
        <i class="fas fa-star"></i> Testimoni
    </a>
    <a href="{{ route('admin.faqs.index') }}" class="nav-link {{ Request::is('admin/faqs*') ? 'active' : '' }}">
        <i class="fas fa-question-circle"></i> FAQ
    </a>

    <div class="nav-section">User</div>
    <a href="{{ route('admin.users.index') }}" class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
        <i class="fas fa-users-cog"></i> Kelola User
    </a>

    <div class="nav-section">Les Privat</div>
    <a href="{{ route('admin.tutors.index') }}" class="nav-link {{ Request::is('admin/tutors*') ? 'active' : '' }}">
        <i class="fas fa-chalkboard-teacher"></i> Guru Privat
    </a>
    <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ Request::is('admin/bookings*') ? 'active' : '' }}">
        <i class="fas fa-calendar-check"></i> Booking
    </a>

    <div class="nav-section">Sistem</div>
    <a href="{{ route('admin.settings') }}" class="nav-link {{ Request::is('admin/settings*') ? 'active' : '' }}">
        <i class="fas fa-cog"></i> Pengaturan
    </a>
    <a href="{{ url('/') }}" class="nav-link" target="_blank">
        <i class="fas fa-external-link-alt"></i> Lihat Website
    </a>
    <a href="{{ url('signout') }}" class="nav-link" onclick="return confirm('Keluar dari admin?')">
        <i class="fas fa-sign-out-alt"></i> Keluar
    </a>
</div>

<!-- Main -->
<div class="admin-main">
    <div class="admin-topbar">
        <div class="d-flex align-items-center">
            <button class="btn btn-sm btn-light d-md-none me-3" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
        </div>
        <div class="d-flex align-items-center gap-3">
            @if(session('success'))
                <span class="badge bg-success">{{ session('success') }}</span>
            @endif
            <span class="badge" style="background:#e8f8f6;color:#1BA89C;font-size:12px;">
                <i class="fas fa-user me-1"></i> {{ auth()->user()->name ?? 'Admin' }}
            </span>
        </div>
    </div>

    <div class="admin-content">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold"><i class="fas fa-exclamation-triangle text-danger me-2"></i>Konfirmasi Hapus</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-1">Anda akan menghapus:</p>
                <p class="fw-semibold" id="deleteItemName" style="color:#333;"></p>
                <p class="text-danger mb-0" style="font-size:13px;"><i class="fas fa-info-circle me-1"></i>Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash me-1"></i>Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index:9999;">
    <div id="adminToast" class="toast align-items-center text-white border-0" role="alert" style="min-width:280px;">
        <div class="d-flex">
            <div class="toast-body" id="toastMessage"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.body.classList.toggle('show-sidebar');
    }
    function confirmDelete(url, name) {
        document.getElementById('deleteItemName').textContent = '"' + name + '"';
        document.getElementById('deleteForm').action = url;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
    // Auto-show toast if session success
    @if(session('success'))
    (function() {
        const toastEl = document.getElementById('adminToast');
        const toastMsg = document.getElementById('toastMessage');
        toastEl.classList.add('bg-success');
        toastMsg.textContent = '✓ {{ session("success") }}';
        const toast = new bootstrap.Toast(toastEl, { delay: 3500 });
        toast.show();
    })();
    @endif
    @if(session('error'))
    (function() {
        const toastEl = document.getElementById('adminToast');
        const toastMsg = document.getElementById('toastMessage');
        toastEl.classList.add('bg-danger');
        toastMsg.textContent = '✗ {{ session("error") }}';
        const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
        toast.show();
    })();
    @endif
</script>
@yield('scripts')
</body>
</html>
