    
    

        @if(Route::is(['index','index-rtl']))
    <!-- Footer -->
			<footer class="footer footer-one">
				<div class="footer-top">
					<div class="container">
						<div class="row row-gap-4">
							<div class="col-lg-4">
								<div class="footer-about">
									<div class="footer-logo">
										<img src="{{URL::asset('build/img/bisolpin-logo.png')}}" alt="">
									</div>
									<p>Platform Bimbingan & Solusi Pintar untuk Masa Depan Lebih Cerah. Temukan kursus, pelatihan profesional, dan bimbingan belajar terbaik.</p>
									<div class="d-flex align-items-center mt-3">
										<a href="https://play.google.com/store/apps/details?id=com.bisolpin.app&pcampaignid=web_share" target="_blank">
                                            <img src="{{URL::asset('build/img/icon/googleplay.svg')}}" alt="Google Play" style="height: 40px;">
                                        </a>
									</div>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="row row-gap-4">
									<div class="col-lg-4 col-md-4">
										<div class="footer-widget footer-menu">
											<h5 class="footer-title">Layanan</h5>
											<ul>
												<li><a href="{{url('course-grid')}}">Bimbingan Belajar</a></li>
												<li><a href="{{url('course-grid')}}">Kursus Online</a></li>
												<li><a href="{{url('course-grid')}}">Pelatihan Profesional</a></li>
											</ul>
										</div>
									</div>
									<div class="col-lg-4 col-md-4">
										<div class="footer-widget footer-menu">
											<h5 class="footer-title">Informasi</h5>
											<ul>
												<li><a href="{{url('about-us')}}">Tentang Kami</a></li>
												<li><a href="{{url('faq')}}">FAQ</a></li>
												<li><a href="{{url('blog-grid')}}">Blog & Artikel</a></li>
												<li><a href="{{url('contact-us')}}">Hubungi Kami</a></li>
											</ul>
										</div>
									</div>
									<div class="col-lg-4 col-md-4">
										<div class="footer-widget footer-menu">
											<h5 class="footer-title">Akses</h5>
											<ul>
												<li><a href="{{url('login')}}">Masuk</a></li>
												<li><a href="{{url('register')}}">Daftar Akun</a></li>
												<li><a href="javascript:void(0);">Karir</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>							
							<div class="col-lg-3">
								<div class="footer-widget footer-contact">
									<h5 class="footer-title">Kontak Kami</h5>
									<div class="footer-contact-info">
										<div class="footer-address">
											<p><i class="isax isax-location text-secondary me-2"></i> JL. M.H. Thamrin No 20 8, Gondangdia, Kec. Menteng, Jakarta Pusat, Tower Lippo Thamrin</p>
										</div>
										<div class="footer-address mt-3">
											<p><i class="isax isax-message text-secondary me-2"></i> info@bisolpin.com</p>
										</div>
										<div class="footer-address mt-3">
											<p><i class="isax isax-call text-secondary me-2"></i> +62 812-3456-7890</p>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-bottom">
					<div class="container">
						<div class="row row-gap-2">
							<div class="col-lg-5">
								<div class="text-center text-lg-start">									
									<p>Copyright 2025 &copy; <span class="text-secondary">Bisolpin.com</span>. All right reserved.</p>
								</div>
							</div>
							<div class="col-lg-4">
								<ul class="d-flex align-items-center justify-content-center footer-link">
									<li><a href="{{url('terms-and-conditions')}}">Syarat & Ketentuan</a></li>
									<li><a href="{{url('privacy-policy')}}">Kebijakan Privasi</a></li>
								</ul>
							</div>
							<div class="col-lg-3">
								<div class="social-icon">
									<a href="javascript:void(0);"><i class="fa-brands fa-facebook-f"></i></a>
									<a href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a>
									<a href="javascript:void(0);"><i class="fa-brands fa-x-twitter"></i></a>
									<a href="javascript:void(0);"><i class="fa-brands fa-youtube"></i></a>
									<a href="javascript:void(0);"><i class="fa-brands fa-linkedin"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!-- /Footer -->
    @endif

   

   

   

   
   
