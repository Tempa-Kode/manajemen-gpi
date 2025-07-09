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
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- =======================================================
  * Template Name: iLanding
  * Template URL: https://bootstrapmade.com/ilanding-bootstrap-landing-page-template/
  * Updated: Nov 12 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="starter-page-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <img src="{{ asset('assets/img/favicon.ico') }}" alt="logo gpi" class="img-fluid">
      </a>

      @include('komponent.navigasi-landing')

      <a class="btn-getstarted" href="index.html#about">Get Started</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <h1>Jadwal Pelayanan</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Jadwal Pelayanan</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

        <div class="container" data-aos="fade-up">
             <!-- Jadwal Berdasarkan Jenis Ibadah -->
          <div class="col-lg-12 mt-5" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
                <h3><i class="fas fa-calendar-alt me-2"></i>Jadwal Pelayanan Bulan {{ $bulanIni }}</h3>
              <p class="text-muted mb-4">Jadwal pelayanan dikelompokkan berdasarkan jenis ibadah untuk bulan {{ $bulanIni }}.</p>

              @if($jenisIbadah->count() > 0)
                <div class="accordion" id="jenisIbadahAccordion">
                  @foreach($jenisIbadah as $index => $jenis)
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                          <i class="fas fa-church me-2"></i>
                          {{ $jenis->jenis_ibadah }}
                          <span class="badge bg-primary ms-2">{{ $jenis->jadwalIbadah->count() }} Jadwal</span>
                        </button>
                      </h2>
                      <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#jenisIbadahAccordion">
                        <div class="accordion-body">
                          @if($jenis->jadwalIbadah->count() > 0)
                            <div class="row">
                              @foreach($jenis->jadwalIbadah as $jadwal)
                                <div class="col-md-6 col-lg-4 mb-3">
                                  <div class="card border-left-primary h-100">
                                    <div class="card-body">
                                      <h6 class="card-title text-primary">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $jadwal->hari }}, {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}
                                      </h6>
                                      <p class="card-text mb-2">
                                        <i class="fas fa-clock me-2 text-muted"></i>
                                        {{ $jadwal->jam }}
                                      </p>
                                      <p class="card-text mb-2">
                                        <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                        {{ $jadwal->tempat ?? 'Gedung Gereja' }}
                                      </p>
                                      @if($jadwal->alamat)
                                        <p class="card-text">
                                          <small class="text-muted">
                                            <i class="fas fa-location-arrow me-1"></i>
                                            {{ Str::limit($jadwal->alamat, 50) }}
                                          </small>
                                        </p>
                                      @endif
                                    </div>
                                  </div>
                                </div>
                              @endforeach
                            </div>
                          @else
                            <div class="alert alert-light" role="alert">
                              <i class="fas fa-info-circle me-2"></i>
                              Belum ada jadwal untuk jenis ibadah <strong>{{ $jenis->jenis_ibadah }}</strong> di bulan ini.
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @else
                <div class="alert alert-warning" role="alert">
                  <i class="fas fa-exclamation-triangle me-2"></i>
                  Belum ada jenis ibadah yang terdaftar.
                </div>
              @endif
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
            <a href=""><i class="bi bi-instagram"></i></a>
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
