{{-- Bisolpin Main Navigation --}}
<ul class="main-nav bisolpin-nav">
    {{-- Beranda --}}
    <li class="{{ Request::is('/') || Request::is('index') ? 'active' : '' }}">
        <a href="{{ url('/') }}">Beranda</a>
    </li>

    {{-- Tentang Kami (dropdown) --}}
    <li class="has-submenu {{ Request::is('about-us', 'kemitraan') ? 'active' : '' }}">
        <a href="#">Tentang Kami <i class="fas fa-chevron-down ms-1" style="font-size:10px;"></i></a>
        <ul class="submenu bisolpin-submenu">
            <li class="{{ Request::is('about-us') ? 'active' : '' }}">
                <a href="{{ url('about-us') }}">Tentang</a>
            </li>
            <li>
                <a href="{{ url('kemitraan') }}">Kemitraan</a>
            </li>
        </ul>
    </li>

    {{-- Layanan --}}
    <li class="{{ Request::is('course-grid', 'course-list', 'course-details', 'course-details-2', 'course-category') ? 'active' : '' }}">
        <a href="{{ url('course-grid') }}">Layanan</a>
    </li>

    {{-- Event --}}
    <li class="{{ Request::is('events', 'event-detail') && !Request::is('about-us') ? 'active' : '' }}">
        <a href="{{ url('events') }}">Event</a>
    </li>

    {{-- Les Privat --}}
    <li class="{{ Request::is('les-privat*') ? 'active' : '' }}">
        <a href="{{ url('les-privat') }}">Les Privat</a>
    </li>

    {{-- Karir --}}
    <li class="{{ Request::is('karir') ? 'active' : '' }}">
        <a href="{{ url('karir') }}">Karir</a>
    </li>

    {{-- Promo --}}
    <li class="{{ Request::is('promo') ? 'active' : '' }}">
        <a href="{{ url('/') }}#promo">Promo</a>
    </li>

    {{-- Blog --}}
    <li class="{{ Request::is('blog-grid', 'blog-details', 'blog-list', 'blog-2-grid', 'blog-3-grid') ? 'active' : '' }}">
        <a href="{{ url('blog-grid') }}">Blog</a>
    </li>

    {{-- FAQ --}}
    <li class="{{ Request::is('faq') ? 'active' : '' }}">
        <a href="{{ url('faq') }}">FAQ</a>
    </li>

    {{-- Kontak --}}
    <li class="{{ Request::is('contact-us') ? 'active' : '' }}">
        <a href="{{ url('contact-us') }}">Kontak</a>
    </li>
</ul>
