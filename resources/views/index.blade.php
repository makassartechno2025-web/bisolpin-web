<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')

        <!-- banner -->
        <section class="banner-section">
            <img class="img-fluid d-none d-lg-flex banner-bg1" src="{{URL::asset('./build/img/bg/bg-15.png')}}" alt="img">
            <img class="img-fluid d-none d-lg-flex banner-bg2" src="{{URL::asset('./build/img/bg/bg-16.png')}}" alt="img" data-aos="fade-up">
            <img class="img-fluid d-none d-lg-flex banner-bg3" src="{{URL::asset('./build/img/bg/bg-17.png')}}" alt="img" data-aos="fade-down">
            <img class="img-fluid d-none d-lg-flex banner-bg4" src="{{URL::asset('./build/img/bg/bg-18.png')}}" alt="img" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-7 col-lg-7">
                        <div class="banner-content pe-xxl-5" data-aos="fade-up">
                        <span class="hero-title">Selamat Datang Disitus BISOLPIN</span>
                        <h1 class="mb-4 text-white">Metode Jitu <span>Bimbingan Belajar</span> Praktis, Efisien, Dan Komprehensif</h1>
                        <p class="fs-lg text-center text-md-start pb-2 pb-md-3 mb-4 text-white">BISOLPIN adalah sebuah perangkat Sistem Edutech Terpadu yang digunakan dalam dunia pendidikan untuk mendukung proses pembelajaran dan bimbingan belajar secara digital bagi siswa dengan praktis, efisien dan komprehensif. Perangkat ini bisa digunakan oleh semua jenjang mulai dari tingkat TK, SD, SMP, SMA/SMK, Mahasiswa, Guru, Orang Tua Murid dan Umum.</p>
                        
                        <form class="banner-search" action="{{url('course-list')}}">
                            <div class="dropdown">
                                <a class="hero-dropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                Pilih Kategori <i class="isax isax-arrow-down5 fs-12"></i>
                                </a>                                      
                                <ul class="dropdown-menu p-1">
                                    <li><a class="dropdown-item" href="#">Bimbingan Belajar</a></li>
                                    <li><a class="dropdown-item" href="#">Kursus Online</a></li>
                                    <li><a class="dropdown-item" href="#">Pelatihan</a></li>
                                </ul>
                            </div>
                            <input type="text" name="search" class="border-0 form-control p-0" placeholder="Cari kursus, pelatihan, atau artikel...">
                            <button type="submit" class="btn btn-secondary ms-auto"><i class="isax isax-arrow-right-1"></i></button>
                        </form>
                        <div class="d-flex align-items-center gap-4 justify-content-lg-between justify-content-center flex-wrap">
                            <div class="counter-item">
                                <div class="counter-icon flex-shrink-0">
                                    <img src="{{URL::asset('build/img/icons/icon-32.svg')}}" alt="img">
                                </div>
                                <div class="count-content">
                                    <h6 class="text-purple mb-0">Solusi Tepat</h6>
                                    <p>untuk sukses</p>
                                </div>    
                            </div> 
                            <div class="counter-item">
                                <div class="counter-icon flex-shrink-0">
                                    <img src="{{URL::asset('build/img/icons/icon-33.svg')}}" alt="img">
                                </div>
                                <div class="count-content">
                                    <h6 class="text-skyblue mb-0">Instruktur Ahli</h6>
                                    <p>yang tepat untukmu</p>
                                </div>    
                            </div> 
                            <div class="counter-item">
                                <div class="counter-icon flex-shrink-0">
                                    <img src="{{URL::asset('build/img/icons/icon-34.svg')}}" alt="img">
                                </div>
                                <div class="count-content">
                                    <h6 class="text-success mb-0">Akses Selamanya</h6>
                                    <p>belajar kapan saja</p>
                                </div>    
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="banner-image" data-aos="fade-up">
                            <div class="swiper swiper-slider-banner">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="course-item-two course-item mb-0">
                                            <div class="course-img">
                                                <img src="{{URL::asset('build/img/course/course-22.jpg')}}" alt="img" class="img-fluid">
                                            </div>
                                            <div class="course-content">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <a href="javascript:void(0);" class="link-default fs-14"><i class="fa-solid fa-calendar me-2"></i>21 Feb 2026</a>
                                                        </div>
                                                    </div>
                                                    <span class="badge badge-light rounded-pill bg-light d-inline-flex align-items-center fs-13 fw-medium">
                                                        Event
                                                    </span>
                                                </div>
                                                <h6 class="mb-2"><a href="#">Workshop Peningkatan Skill Dalam Bidang Komputer Dan Bisnis Digital</a></h6>
                                                <div class="d-flex align-items-center justify-content-between mt-3">
                                                    <h6 class="text-secondary fs-16 fw-semi-bold mb-0">Gratis</h6>
                                                    <a href="#" class="btn btn-dark btn-sm d-inline-flex align-items-center">Daftar<i class="isax isax-arrow-right-3 ms-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="course-item-two course-item mb-0">
                                            <div class="course-img">
                                                <img src="{{URL::asset('build/img/course/course-25.jpg')}}" alt="img" class="img-fluid">
                                            </div>
                                            <div class="course-content">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <a href="javascript:void(0);" class="link-default fs-14"><i class="fa-solid fa-calendar me-2"></i>08 Feb 2026</a>
                                                        </div>
                                                    </div>
                                                    <span class="badge badge-light rounded-pill bg-light d-inline-flex align-items-center fs-13 fw-medium">
                                                        Event
                                                    </span>
                                                </div>
                                                <h6 class="mb-2"><a href="#">Workshop Pemanfaatan AI Bagi Guru Dalam Dunia Pendidikan</a></h6>
                                                <div class="d-flex align-items-center justify-content-between mt-3">
                                                    <h6 class="text-secondary fs-16 fw-semi-bold mb-0">Gratis</h6>
                                                    <a href="#" class="btn btn-dark btn-sm d-inline-flex align-items-center">Daftar<i class="isax isax-arrow-right-3 ms-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="course-item-two course-item mb-0">
                                            <div class="course-img">
                                                <img src="{{URL::asset('build/img/course/course-24.jpg')}}" alt="img" class="img-fluid">
                                            </div>
                                            <div class="course-content">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <a href="javascript:void(0);" class="link-default fs-14"><i class="fa-solid fa-calendar me-2"></i>07 Feb 2026</a>
                                                        </div>
                                                    </div>
                                                    <span class="badge badge-light rounded-pill bg-light d-inline-flex align-items-center fs-13 fw-medium">
                                                        Event
                                                    </span>
                                                </div>
                                                <h6 class="mb-2"><a href="#">BISOLPIN mengadakan Try Out Dan Bimbingan Belajar Gratis</a></h6>
                                                <div class="d-flex align-items-center justify-content-between mt-3">
                                                    <h6 class="text-secondary fs-16 fw-semi-bold mb-0">Gratis</h6>
                                                    <a href="#" class="btn btn-dark btn-sm d-inline-flex align-items-center">Daftar<i class="isax isax-arrow-right-3 ms-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /banner -->
        <!-- Blog & Artikel -->
        <section class="section latest-blog pt-5 mt-4 pb-0">
            <div class="container">
                <div class="section-header text-center" data-aos="fade-up">
                    <span class="fw-medium text-secondary text-decoration-underline mb-2 d-inline-block">Artikel & Berita</span>
                    <h2>Artikel & Berita Terbaru</h2>
                    <p class="sub-title">Ikuti perkembangan terbaru di dunia pendidikan dan pelatihan</p>
                </div>
                <div class="row">
                    @forelse($articles as $article)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm" style="border-radius:12px;overflow:hidden;" data-aos="fade-up">
                            <a href="{{ url('blog-grid') }}"><img src="{{ $article->image_url ?? URL::asset('build/img/blog/blog-35.jpg') }}" alt="" style="height:200px;object-fit:cover;width:100%;"></a>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge" style="background:#e8f8f6;color:#1BA89C;">{{ $article->category->name ?? 'Berita' }}</span>
                                    <small class="text-muted"><i class="far fa-calendar-alt me-1"></i>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</small>
                                </div>
                                <h5 class="card-title mt-2"><a href="{{ url('blog-grid') }}" class="text-dark">{{ Str::limit($article->title, 50) }}</a></h5>
                                <p class="text-muted small mt-2">{{ Str::limit($article->excerpt, 80) }}</p>
                            </div>
                            <div class="card-footer bg-white border-0 px-4 pb-4 pt-0 d-flex justify-content-between align-items-center">
                                <small class="text-muted"><i class="fas fa-user-circle me-1"></i>{{ $article->author }}</small>
                                <a href="{{ url('blog-grid') }}" style="font-size:13px;font-weight:600;color:#1BA89C;">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-4 text-muted">Belum ada artikel.</div>
                    @endforelse
                </div>
            </div>
        </section>
        <!-- /Blog & Artikel -->
        <!-- Layanan -->
        <section id="layanan" class="benefit-section">
            <div class="container">
                <div class="section-header text-center">
                    <span class="fw-medium text-secondary text-decoration-underline mb-2 d-inline-block">Layanan Kami</span>
                    <h2>Kami Berfokus pada Teknologi dan Pembelajaran Inovatif</h2>
                    <p>Misi kami adalah memberdayakan peserta dengan pengetahuan, keterampilan, dan pola pikir yang dibutuhkan untuk sukses. Kami percaya bahwa pendidikan lebih dari sekadar akademisâ€”pendidikan adalah tentang membentuk individu yang berkarakter, percaya diri, dan seimbang.</p>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <div class="position-absolute top-0 end-0 mt-n3 me-n4">
                                    <img src="{{URL::asset('./build/img/shapes/bg-1.png')}}" alt="img">
                                </div>
                                <div class="p-4 rounded-pill bg-primary-transparent d-inline-flex">
                                    <i class="isax isax-book-1 fs-24"></i>
                                </div>
                                <h5 class="mt-3 mb-1">Platform Pembelajaran Digital</h5>
                                <p>Akses lebih mudah dimana saja.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <div class="position-absolute top-0 end-0 mt-n3 me-n4">
                                    <img src="{{URL::asset('build/img/shapes/bg-2.png')}}" alt="img">
                                </div>
                                <div class="p-4 rounded-pill bg-secondary-transparent d-inline-flex">
                                    <i class="isax isax-monitor5 fs-24"></i>
                                </div>
                                <h5 class="mt-3 mb-1">Smart Classrooms</h5>
                                <p>Interaktif, dan konten digital untuk pengalaman belajar yang lebih baik.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <div class="position-absolute top-0 end-0 mt-n3 me-n4">
                                    <img src="{{URL::asset('build/img/shapes/bg-3.png')}}" alt="img">
                                </div>
                                <div class="p-4 rounded-pill bg-skyblue-transparent d-inline-flex">
                                    <i class="isax isax-chart-26 fs-24"></i>
                                </div>
                                <h5 class="mt-3 mb-1">Program Pembelajaran Coding</h5>
                                <p>Kami Melayani Pembelajaran Khusus Bagi Siswa Yang Ingin Belajar Coding.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Layanan -->

        <!-- Login/Register CTA -->
        <section class="trust-sec">
            <div class="container">
                <div class="trust-content">
                    <img src="{{URL::asset('./build/img/bg/bg-19.png')}}" alt="img" class="w-100 trust-bg">
                    <div class="row justify-content-between">
                        <div class="col-md-4">
                            <h4>Mulai Belajar dengan Sistem Edutech Terpadu</h4>
                            <p class="text-white mt-3 mb-0" style="opacity: 0.9;">BISOLPIN adalah sebuah perangkat Sistem Edutech Terpadu yang praktis, efisien dan komprehensif. Bisa digunakan oleh semua jenjang mulai dari tingkat TK, SD, SMP, SMA/SMK, Mahasiswa, Guru, Orang Tua Murid dan Umum.</p>
                            <div class="d-flex align-items-center flex-wrap mt-4 gap-2">
                                <a href="{{url('login')}}" class="btn btn-secondary">Masuk</a>
                                <a href="{{url('register')}}" class="btn btn-dark">Daftar Akun</a>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="text-white mb-2">0+</h4>
                                    <h5 class="text-white mb-2">Kursus</h5>
                                    <p class="text-white mb-5">Materi interaktif dan komprehensif.</p>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="text-white mb-2">0K+</h4>
                                    <h5 class="text-white mb-2">Terdaftar</h5>
                                    <p class="text-white mb-5">Bergabung bersama ribuan pelajar lainnya.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center bg-white user-goal p-2">
                                <div class="avatar avatar-lg flex-shrink-0">
                                    <img class="rounded-pill" src="{{URL::asset('./build/img/user/user-28.jpg')}}" alt="img">
                                </div>
                                <p class="text-gray-9 mb-0">"Bisolpin membantu saya meraih impian dengan bimbingan yang tepat"</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Login/Register CTA -->
        <!-- Event -->
        <section class="top-courses-sec">
            <img class="top-courses-bg" src="{{URL::asset('./build/img/bg/bg-20.png')}}" alt="img">
            <div class="container">
                <div class="section-header text-center">
                    <span class="fw-medium text-secondary text-decoration-underline mb-2 d-inline-block">Event & Kegiatan</span>
                    <h2>Event Mendatang</h2>
                    <p>Ikuti berbagai event dan kegiatan menarik yang kami selenggarakan</p>
                </div>
                <div class="top-courses-slider lazy">
                    <div>
                        <div class="categories-item categories-item-three mb-0">
                            <img class="mx-auto" src="{{URL::asset('build/img/category/icons/icon-6.svg')}}" alt="img">
                            <h6 class="title"><a href="#">Workshop Peningkatan Skill Dalam Bidang Komputer Dan Bisnis Digital</a></h6>
                        </div>
                    </div>
                    <div>
                        <div class="categories-item categories-item-three mb-0">
                            <img class="mx-auto" src="{{URL::asset('build/img/category/icons/icon-7.svg')}}" alt="img">
                            <h6 class="title"><a href="#">Workshop Pemanfaatan AI Bagi Guru Dalam Dunia Pendidikan</a></h6>
                        </div>
                    </div>
                    <div>
                        <div class="categories-item categories-item-three mb-0">
                            <img class="mx-auto" src="{{URL::asset('build/img/category/icons/icon-8.svg')}}" alt="img">
                            <h6 class="title"><a href="#">BISOLPIN mengadakan Try Out Dan Bimbingan Belajar Gratis</a></h6>
                        </div>
                    </div>
                    <div>
                        <div class="categories-item categories-item-three mb-0">
                            <img class="mx-auto" src="{{URL::asset('build/img/category/icons/icon-9.svg')}}" alt="img">
                            <h6 class="title"><a href="#">Pelatihan Public Speaking</a></h6>
                        </div>
                    </div>
                    <div>
                        <div class="categories-item categories-item-three mb-0">
                            <img class="mx-auto" src="{{URL::asset('build/img/category/icons/icon-6.svg')}}" alt="img">
                            <h6 class="title"><a href="#">Workshop UI/UX Design</a></h6>
                        </div>
                    </div>
                    <div>
                        <div class="categories-item categories-item-three mb-0">
                            <img class="mx-auto" src="{{URL::asset('build/img/category/icons/icon-7.svg')}}" alt="img">
                            <h6 class="title"><a href="#">Seminar Kewirausahaan</a></h6>
                        </div>
                    </div>
                </div>
                <a href="#" class="btn btn-primary btn-md">Lihat Semua Event</a>
            </div>
        </section>
        <!-- /Event -->

        <!-- Karir -->
        <div id="karir" class="how-it-works-sec-two">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="me-5" data-aos="fade-up">
                            <img src="{{URL::asset('build/img/feature/feature-27.jpg')}}" class="img-fluid rounded-5" alt="img">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="how-it-works-content aos" data-aos="fade-up">
                            <div class="section-header">
                                <span class="fw-medium text-secondary text-decoration-underline mb-2 d-inline-block">Peluang Karir</span>
                                <h2 class="mb-1">Peluang Karir di Bisolpin</h2>
                                <p>Bergabunglah bersama kami untuk menciptakan dampak positif bagi komunitas dan dunia pendidikan.</p>
                            </div>
                            <div class="d-flex align-items-center works-items">
                                <span class="count">01</span>
                                <div>
                                    <h5 class="mb-1">Kirim CV & Portofolio</h5>
                                    <p>Kirimkan CV dan portofolio terbaikmu melalui halaman karir kami.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center works-items">
                                <span class="count">02</span>
                                <div>
                                    <h5 class="mb-1">Proses Seleksi</h5>
                                    <p>Tim HR kami akan meninjau dan menghubungi kandidat yang sesuai.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center works-items">
                                <span class="count">03</span>
                                <div>
                                    <h5 class="mb-1">Interview</h5>
                                    <p>Ikuti sesi interview untuk menunjukkan kemampuan terbaikmu.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center works-items mb-0 pb-0 border-0">
                                <span class="count">04</span>
                                <div>
                                    <h5 class="mb-1">Bergabung!</h5>
                                    <p>Selamat! Mulai perjalanan karirmu bersama tim Bisolpin.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Karir -->
        <!-- Testimoni -->
        <div class="testimonials-section testimonials-sec-one text-center">
            <div class="container">
                <div class="section-header text-center" data-aos="fade-up">
                    <span class="fw-medium text-secondary text-decoration-underline mb-2 d-inline-block">Testimoni</span>
                    <h2>Apa Kata Mereka</h2>
                    <p>Pengalaman nyata dari para peserta yang telah merasakan manfaat Bisolpin</p>
                </div>
                <div class="testimonials-slider lazy mt-4">
                    <div>
                        <div class="testimonials-item rounded-3 bg-white" data-aos="flip-right">
                            <div class="position-relative d-inline-flex">
                                <div class="avatar rounded-circle avatar-xxl border border-white border-3">
                                    <a href="#"><img class="img-fluid rounded-circle" src="{{URL::asset('./build/img/user/user-41.jpg')}}" alt="img"></a>
                                </div>
                                <i class="isax isax-quote-up5 bg-secondary quote rounded-pill fs-16 p-1"></i>
                            </div>
                            <h6 class="mb-1"><a href="#">Farel</a></h6>
                            <p class="designation">Siswa</p>
                            <p class="mb-3 text-truncate line-clamb-2">Bimbel digital ini sangat membantu saya menghadapi ujian. Materinya lengkap, penjelasan tutor mudah dipahami, dan saya bisa belajar kapan saja tanpa terbatas waktu. Nilai try out saya meningkat signifikan setelah ikut program ini.</p>
                            <div>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="testimonials-item rounded-3 bg-white" data-aos="flip-right">
                            <div class="position-relative d-inline-flex">
                                <div class="avatar rounded-circle avatar-xxl border border-white border-3">
                                    <a href="#"><img class="img-fluid rounded-circle" src="{{URL::asset('./build/img/user/user-42.jpg')}}" alt="img"></a>
                                </div>
                                <i class="isax isax-quote-up5 bg-secondary quote rounded-pill fs-16 p-1"></i>
                            </div>
                            <h6 class="mb-1"><a href="#">Fidto Gunarwan</a></h6>
                            <p class="designation">Siswa</p>
                            <p class="mb-3 text-truncate line-clamb-2">Awalnya saya ragu ikut bimbel digital, tapi ternyata sangat efektif. Saya suka karena bisa mengulang materi video sampai benar-benar paham. Fitur diskusi dengan tutor juga membuat saya merasa tidak belajar sendirian.</p>
                            <div>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="testimonials-item rounded-3 bg-white" data-aos="flip-right">
                            <div class="position-relative d-inline-flex">
                                <div class="avatar rounded-circle avatar-xxl border border-white border-3">
                                    <a href="#"><img class="img-fluid rounded-circle" src="{{URL::asset('./build/img/user/user-43.jpg')}}" alt="img"></a>
                                </div>
                                <i class="isax isax-quote-up5 bg-secondary quote rounded-pill fs-16 p-1"></i>
                            </div>
                            <h6 class="mb-1"><a href="#">Fiqhi Setiawan</a></h6>
                            <p class="designation">Tutor</p>
                            <p class="mb-3 text-truncate line-clamb-2">Mengajar di bimbel digital ini menyenangkan karena platformnya interaktif. Saya bisa memberikan materi, latihan soal, bahkan kuis dengan mudah. Senang rasanya bisa membantu siswa belajar lebih fleksibel namun tetap fokus pada tujuan akademik mereka.</p>
                            <div>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="testimonials-item rounded-3 bg-white">
                            <div class="position-relative d-inline-flex">
                                <div class="avatar rounded-circle avatar-xxl border border-white border-3">
                                    <a href="#"><img class="img-fluid rounded-circle" src="{{URL::asset('./build/img/user/user-43.jpg')}}" alt="img"></a>
                                </div>
                                <i class="isax isax-quote-up5 bg-secondary quote rounded-pill fs-16 p-1"></i>
                            </div>
                            <h6 class="mb-1"><a href="#">Dewi Lestari</a></h6>
                            <p class="designation">Guru</p>
                            <p class="mb-3 text-truncate line-clamb-2">Platform yang luar biasa untuk pengembangan diri. Saya belajar banyak hal baru setiap harinya.</p>
                            <div>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Testimoni -->
        <!-- Download APK -->
        <section class="community-to-learn">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="section-header">
                            <span class="fw-medium text-secondary text-decoration-underline mb-2 d-inline-block">Aplikasi Mobile</span>
                            <h2>Download Aplikasi Bisolpin</h2>
                            <p>Akses semua fitur Bisolpin langsung dari smartphone Anda. Belajar kapan saja, di mana saja dengan aplikasi mobile kami.</p>
                        </div>
                        <div class="community-item d-flex align-items-center">
                            <span class="community-icon-1">
                                <i class="isax isax-book-saved5"></i>
                            </span>
                            <div>
                                <h5 class="mb-2">Belajar di Mana Saja</h5>
                                <p class="mb-0">Akses materi kursus dan bimbingan langsung dari genggaman tangan Anda.</p>
                            </div>
                        </div>
                        <div class="community-item d-flex align-items-center">
                            <span class="community-icon-2">
                                <i class="isax isax-notification5"></i>
                            </span>
                            <div>
                                <h5 class="mb-2">Notifikasi Real-time</h5>
                                <p class="mb-0">Dapatkan pemberitahuan jadwal kelas, event, dan promo terbaru secara langsung.</p>
                            </div>
                        </div>
                        <div class="community-item d-flex align-items-center">
                            <span class="community-icon-3">
                                <i class="isax isax-chart-26"></i>
                            </span>
                            <div>
                                <h5 class="mb-2">Pantau Progres Belajar</h5>
                                <p class="mb-0">Lacak kemajuan belajar Anda dengan dashboard yang mudah dipahami.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <a href="https://play.google.com/store/apps/details?id=com.bisolpin.app&pcampaignid=web_share" target="_blank">
                                <img src="{{URL::asset('build/img/icon/googleplay.svg')}}" alt="Google Play" style="height: 48px;">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="community-img d-none d-lg-flex">
                            <img src="{{URL::asset('build/img/shapes/shape-5.png')}}" alt="img" class="img-fluid community-img-01">
                            <img src="{{URL::asset('build/img/shapes/shape-6.png')}}" alt="img" class="img-fluid community-img-02">
                            <img src="{{URL::asset('build/img/feature/feature-2.jpg')}}" alt="img" class="img-fluid community-img-03"> 
                            <img src="{{URL::asset('build/img/feature/feature-3.jpg')}}" alt="img" class="img-fluid community-img-04"> 
                            <img src="{{URL::asset('build/img/shapes/shape-7.svg')}}" alt="img" class="img-fluid community-img-05"> 
                            <div class="community-count p-2">
                                <div class="enrolled-list">
                                    <div class="avatar-list-stacked mb-2">
                                        <span class="avatar avatar-rounded">
                                            <img class="border border-white" src="{{URL::asset('build/img/user/user-01.jpg')}}" alt="img">
                                        </span>
                                        <span class="avatar avatar-rounded">
                                            <img class="border border-white" src="{{URL::asset('build/img/user/user-03.jpg')}}" alt="img">
                                        </span>
                                        <span class="avatar avatar-rounded">
                                            <img class="border border-white" src="{{URL::asset('build/img/user/user-07.jpg')}}" alt="img">
                                        </span>
                                        <span class="avatar avatar-rounded">
                                            <img class="border border-white" src="{{URL::asset('build/img/user/user-08.jpg')}}" alt="img">
                                        </span>
                                    </div>
                                    <p class="mb-0"><span class="text-secondary">5K+</span> Pengguna Aktif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Download APK -->

@endsection


