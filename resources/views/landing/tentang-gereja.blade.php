<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tentang Gereja</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">
  <link href="{{ asset('landing/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('landing/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('landing/assets/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: iLanding
  * Template URL: https://bootstrapmade.com/ilanding-bootstrap-landing-page-template/
  * Updated: Nov 12 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="starter-page-page">

  @include('komponent.navigasi-landing')

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <h1>Tentang Gereja</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Tentang Gereja</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

        <div class="container" data-aos="fade-up">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">Profile Gereja</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sejarah-tab" data-bs-toggle="tab" data-bs-target="#sejarah-tab-pane"
                        type="button" role="tab" aria-controls="sejarah-tab-pane" aria-selected="false">Sejarah Gereja</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="visi-tab" data-bs-toggle="tab" data-bs-target="#visi-tab-pane"
                        type="button" role="tab" aria-controls="visi-tab-pane" aria-selected="false">Visi Misi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tujuan-tab" data-bs-toggle="tab" data-bs-target="#tujuan-tab-pane"
                        type="button" role="tab" aria-controls="tujuan-tab-pane" aria-selected="false">Tujuan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info-tab-pane"
                        type="button" role="tab" aria-controls="info-tab-pane" aria-selected="false">Info</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active p-3" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    <h3>Profil GPI Sidang Perawang</h3>
                    <p>
                        Gereja Pentakosta Indonesia Sidang Perawang adalah bagian dari Gereja Pentakosta
                        Indonesia yang berfokus pada pengembangan iman Kristen di wilayah Perawang, Riau.
                        Gereja ini berada di Kecamatan Tualang Kabupaten Siak. Lebih tepatnya beralamatkan di Jln.
                        Pery No.36, KM 3 Perawang, dengan kode pos 28772. Jumlah jemaat Gereja Pentakosta
                        Indonesia Sidang perawang saat ini ada 46 KK. Yang mana, keseluruhannya jemaatnya dari
                        orang tua dan anak-anak mencapai 230 jiwa. Berikut adalah gambar atau foto dari Gereja
                        Pentakosta Indonesia Sidang Perawang.
                    </p>
                </div>
                <div class="tab-pane fade p-3" id="sejarah-tab-pane" role="tabpanel" aria-labelledby="sejarah-tab" tabindex="0">
                    <h3>Sejarah Gereja Pentakosta Indonesia (GPI) Sidang Perawang</h3>
                    <p>
                        April tahun 1995 Gereja Pentakosta Indonesia (GPI) Sidang Perawang memulai
                        kegiatan gereja dari ibadah yang dilakukan di rumah-rumah jemaat. Dikarenakan, terbatasnya
                        tempat atau bangunan gereja yang pada saat itu belum ada. Selama setahun lebih ibadah dan
                        kegiatan gereja hanya dilakukan dirumah jemaat saja. Sampai akhirnya di bulan Agustus
                        1996 dimulailah pembangunan gereja ini.
                    </p>
                    <p>
                        GPI Sidang Perawang ini didirikan dimulai dengan bangunan yang sangat sederhana.
                        Yang pada saat itu dibangun di atas lahan bergambut dan berlumpur yang masih digenangi
                        air. Dibangun diatas dengan menggunakan tiang balok kayu. Pada saat itu juga gereja bisa
                        berdiri masih menggunakan papan yang sangat sederhana. Seiring berjalannya waktu,
                        pembangunan gereja ini semakin maju. Oleh karena semangat Pentakosta, para umat Tuhan
                        semakin dan tetap setia melayani Tuhan. Karena sukacita para jemaat GPI Sidang Perawang
                        semakin berlimpah, dan oleh berkat Tuhan, dimulailah dengan pembangunan selanjutnya.
                    </p>
                    <p>
                        September 1996 ibadah gereja sudah di lakukan langsung di Gereja dengan bangunan
                        yang sangat sederhana sampai dengan saat ini. Seluruh aktivitas kegiatan pelayanan gereja
                        juga sudah mulai dilakukan di gereja. Pada tahun 1998 tepatnya di bulan November
                        dimulailah pembangunan tahap kedua. Bangunan gereja ini dibuat untuk bangunan permanen.
                        Mulai dibangun menggunakan beton dan dibuat memakai Plafon Olympic. Lantai gereja juga
                        sudah memakai keramik
                    </p>
                </div>
                <div class="tab-pane fade p-3" id="visi-tab-pane" role="tabpanel" aria-labelledby="visi-tab" tabindex="0">
                    <h3 class="mb-4">Visi dan Misi GPI Sidang Perawang</h3>
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <p class="lead">Gereja Pentakosta Indonesia (GPI) Sidang Perawang memiliki visi dan misi yang menginspirasi untuk membangun komunitas iman yang kuat dan melayani sesama.</p>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary rounded-circle p-3 me-3">
                                            <i class="bi bi-eye-fill text-white fs-4"></i>
                                        </div>
                                        <h4 class="card-title mb-0 text-primary">Visi</h4>
                                    </div>
                                    <blockquote class="blockquote">
                                        <p class="mb-0 fst-italic">"Menjadi Gereja yang di Berkati untuk Menjadi Berkat"</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-success rounded-circle p-3 me-3">
                                            <i class="bi bi-bullseye text-white fs-4"></i>
                                        </div>
                                        <h4 class="card-title mb-0 text-success">Misi</h4>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            Meningkatkan semangat persekutuan dan pelayanan
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            Meningkatkan kehidupan rohani setiap keluarga
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            Membangun pelayanan umat melalui kunjungan kasih
                                        </li>
                                        <li class="mb-0">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            Mewujudkan umat Allah yang teguh dalam iman dan pengharapan
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade p-3" id="tujuan-tab-pane" role="tabpanel" aria-labelledby="tujuan-tab" tabindex="0">
                    <h3>Tujuan GPI Sidang Perawang</h3>
                    <p>
                        Melalui visi dan misi gereja, Gereja Pentakosta Indonesia Sidang Perawang juga
                        mempunyai tujuan, yaitu untuk mewartakan keselamatan dan mengerjakan amanat Agung
                        agar setiap umat hidup di dalam pimpinan Roh Kudus
                    </p>
                </div>
                <div class="tab-pane fade p-3" id="info-tab-pane" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                    <h3 class="mb-4">Informasi Kontak</h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <div class="bg-info rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px;">
                                        <i class="bi bi-telephone-fill text-white fs-4"></i>
                                    </div>
                                    <h5 class="card-title text-info">Nomor Telepon</h5>
                                    <p class="card-text">
                                        <a href="tel:088271082604" class="text-decoration-none">
                                            <strong>088271082604</strong>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <div class="bg-gradient rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px; background: linear-gradient(45deg, #e1306c, #fd1d1d, #f77737, #fcaf45, #ffdc80);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-instagram" viewBox="0 0 16 16">
                                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                        </svg>
                                    </div>
                                    <h5 class="card-title" style="color: #e1306c;">Instagram</h5>
                                    <p class="card-text">
                                        <a href="https://instagram.com/youth_gpi_prwg" target="_blank" class="text-decoration-none" style="color: #e1306c;">
                                            <strong>@youth_gpi_prwg</strong>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-light border-0 shadow-sm mt-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill text-primary me-3 fs-4"></i>
                            <div>
                                <h6 class="mb-1">Hubungi Kami</h6>
                                <small class="text-muted">Jangan ragu untuk menghubungi kami melalui kontak di atas untuk informasi lebih lanjut tentang kegiatan gereja.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Starter Section Section -->

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
            <p class="mt-3"><strong>Phone:</strong> <span>+62 853 0875 8765</span></p>
            <p><strong>Email:</strong> <span>info@gpi.org</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/youth_gpi_prwg?igsh=c3owNHRnNGhyMjV4"><i class="bi bi-instagram"></i></a>
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
      <p>© <span>Copyright</span> <strong class="px-1 sitename">GPI Sidang Perawang</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('landing/assets/js/main.js') }}"></script>

</body>

</html>
