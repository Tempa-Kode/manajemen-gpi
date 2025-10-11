<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>GPI Sidang Perawang</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset("assets/img/favicon.ico") }}" rel="icon">
    <link href="{{ asset("landing/assets/img/apple-touch-icon.png") }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset("landing/assets/vendor/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("landing/assets/vendor/bootstrap-icons/bootstrap-icons.css") }}" rel="stylesheet">
    <link href="{{ asset("landing/assets/vendor/aos/aos.css") }}" rel="stylesheet">
    <link href="{{ asset("landing/assets/vendor/glightbox/css/glightbox.min.css") }}" rel="stylesheet">
    <link href="{{ asset("landing/assets/vendor/swiper/swiper-bundle.min.css") }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset("landing/assets/css/main.css") }}" rel="stylesheet">
</head>

<body class="index-page">

    @include("komponent.navigasi-landing")

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section"
            style="background-image: url('{{ asset("landing/assets/img/hero-img.jpg") }}'); background-size: cover; background-position: center; background-repeat: no-repeat; position: relative;">

            <!-- Overlay untuk opacity dan gradien -->
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0.5) 100%); z-index: 1;">
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                            <div class="company-badge mb-4">
                                👋 Selamat datang diwebsite resmi
                            </div>

                            <h1 class="mb-4">
                                Gereja Pentakosta <br>
                                Indonesia <br>
                                <span class="accent-text">Sidang Perawang</span>
                            </h1>

                            <p class="mb-4 mb-md-5"></p>

                            <div class="hero-buttons">
                                <a href="{{ route("pendaftaranIbadah") }}"
                                    class="btn btn-primary me-0 me-sm-2 mx-1">Daftar Ibadah</a>
                                <a href="{{ route("ucapan-syukur.submit") }}"
                                    class="btn btn-primary me-0 me-sm-2 mx-1">Ucapan Syukur</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
                            <img src="{{ asset("assets/img/logo-gpi-hero.png") }}" alt="Hero Image" class="w-75">
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Hero Section -->

        <!-- Saran & Masukan Section -->
        <section id="contact" class="contact section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Saran & Masukan</h2>
                <p>Silakan berikan saran dan masukan Anda untuk meningkatkan pelayanan kami.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4 g-lg-5">
                    <div class="col-lg-5">
                        <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                            <h3>Informasi Kontak</h3>
                            <p>Silakan hubungi kami melalui informasi berikut:</p>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="content">
                                    <h4>Lokasi Kami</h4>
                                    <p>Jl. Pery No. 36 Km. 3 Perawang, Tualang</p>
                                    <p>Kabupanten Siak, Riau</p>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon-box">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div class="content">
                                    <h4>Nomor Telepon</h4>
                                    <p>082267087169</p>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                                <div class="icon-box">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="content">
                                    <h4>Email Address</h4>
                                    <p>info@gpi.org</p>
                                    <p>contact@gpi.org</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                            <h3>Saran & Masukan</h3>
                            <p>Silakan berikan saran dan masukan Anda untuk meningkatkan pelayanan kami.</p>

                            <form action="{{ route('saran-masukan.submit') }}" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="200">
                            @csrf
                            @method('POST')
                                <div class="row gy-4">

                                    <div class="col-md-6">
                                        <input type="text" name="nama" class="form-control"
                                            placeholder="Nama Anda" required="">
                                    </div>

                                    <div class="col-md-6 ">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Email Anda" required="">
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form-control" name="subjek"
                                            placeholder="Subjek" required="">
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" name="pesan" rows="6" placeholder="Saran & Masukan Anda" required=""></textarea>
                                    </div>

                                    <div class="col-12 text-center">
                                        <div class="loading">Loading</div>
                                        <div class="error-message"></div>
                                        <div class="sent-message">Saran & masukan Anda telah dikirim. Terima kasih!</div>

                                        <button type="submit" class="btn">Kirim Pesan</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Contact Section -->
    </main>

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4 justify-content-between">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">GPI SIdang Perawang</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Pery No. 36 Km. 3 Perawang, Tualang</p>
                        <p>Kabupanten Siak, Riau</p>
                        <p class="mt-3"><strong>Phone Gereja:</strong> <span>0882-7107-7095</span></p>
                        <p class="mt-3"><strong>Contact System:</strong> <span>082267087169 </span></p>
                        <p><strong>Email:</strong> <span>info@gpi.org</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/youth_gpi_prwg?igsh=c3owNHRnNGhyMjV4"><i
                                class="bi bi-instagram"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Tentang Gereja</a></li>
                        <li><a href="#">Jadwal Pelayanan</a></li>
                        <li><a href="#">Pendaftaran Ibadah</a></li>
                        <li><a href="#">Struktur Gereja</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">GPI Sidang Perawang</strong> <span>by Olivia Veronika Sitinjak</span></p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset("landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    {{-- <script src="{{ asset("landing/assets/vendor/php-email-form/validate.js") }}"></script> --}}
    <script src="{{ asset("landing/assets/vendor/aos/aos.js") }}"></script>
    <script src="{{ asset("landing/assets/vendor/glightbox/js/glightbox.min.js") }}"></script>
    <script src="{{ asset("landing/assets/vendor/swiper/swiper-bundle.min.js") }}"></script>
    <script src="{{ asset("landing/assets/vendor/purecounter/purecounter_vanilla.js") }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset("landing/assets/js/main.js") }}"></script>

</body>

</html>
