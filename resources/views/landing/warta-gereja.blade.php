<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Warta Gereja - GPI Sidang Perawang</title>
  <meta name="description" content="Warta Gereja GPI Sidang Perawang">
  <meta name="keywords" content="warta gereja, informasi gereja, gpi perawang">

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

  <style>
    .warta-container {
      background: #f8f9fa;
      padding: 60px 0;
      min-height: 100vh;
    }

    .section-title {
      text-align: center;
      margin-bottom: 50px;
      color: #2c4964;
    }

    .section-title h2 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .section-title p {
      font-size: 1.1rem;
      color: #666;
      max-width: 600px;
      margin: 0 auto;
    }

    .warta-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-bottom: 30px;
      transition: all 0.3s ease;
    }

    .warta-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .warta-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 2px solid #e9ecef;
    }

    .warta-date {
      color: #ff6b35;
      font-weight: 600;
      font-size: 0.9rem;
    }

    .warta-status {
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      text-transform: uppercase;
    }

    .status-published {
      background: #d4edda;
      color: #155724;
    }

    .warta-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #2c4964;
      margin-bottom: 15px;
    }

    .warta-title a {
      color: #2c4964;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .warta-title a:hover {
      color: #ff6b35;
    }

    .warta-content {
      color: #666;
      line-height: 1.7;
      margin-bottom: 20px;
    }

    .warta-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }

    .btn-read-more {
      background: linear-gradient(45deg, #ff6b35, #f93d00);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 25px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-read-more:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
      color: white;
    }

    .no-warta {
      text-align: center;
      padding: 60px 20px;
      color: #666;
    }

    .no-warta i {
      font-size: 4rem;
      color: #ddd;
      margin-bottom: 20px;
    }

    .pagination-wrapper {
      display: flex;
      justify-content: center;
      margin-top: 40px;
    }

    .pagination .page-link {
      color: #2c4964;
      border-color: #ddd;
      margin: 0 2px;
      border-radius: 8px;
    }

    .pagination .page-link:hover {
      background-color: #ff6b35;
      border-color: #ff6b35;
      color: white;
    }

    .pagination .page-item.active .page-link {
      background-color: #ff6b35;
      border-color: #ff6b35;
    }

    @media (max-width: 768px) {
      .warta-meta {
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
      }

      .warta-title {
        font-size: 1.3rem;
      }

      .section-title h2 {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body class="starter-page-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">
        <img src="{{ asset('assets/img/favicon.ico') }}" alt="logo gpi" class="img-fluid">
      </a>

      @include('komponent.navigasi-landing')

      <a class="btn-getstarted" href="{{ route('home') }}#about">Get Started</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <h1>Warta Gereja</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Warta Gereja</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Warta Gereja Section -->
    <section class="warta-container">
      <div class="container">
        <!-- Section Title -->
        <div class="section-title" data-aos="fade-up">
          <h2>Warta Gereja</h2>
          <p>Informasi terkini dan pengumuman penting dari GPI Sidang Perawang untuk seluruh jemaat dan pengunjung.</p>
        </div>

        <!-- Warta List -->
        <div class="row">
          <div class="col-lg-12">
            @if($wartaGereja->count() > 0)
              @foreach($wartaGereja as $warta)
                <div class="warta-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                  <div class="warta-meta">
                    <div class="warta-date">
                      <i class="fas fa-calendar-alt me-2"></i>
                      {{ \Carbon\Carbon::parse($warta->tanggal)->translatedFormat('d F Y') }}
                    </div>
                  </div>

                  <h3 class="warta-title">
                    <a href="{{ route('detailWartaGereja', $warta->id) }}">
                      {!! $warta->nama_warta !!}
                    </a>
                  </h3>

                  <div class="warta-content">
                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($warta->warta), 150, '...') }}</p>
                  </div>

                  <div class="warta-actions">
                    <a href="{{ route('detailWartaGereja', $warta->id) }}" class="btn-read-more">
                      <i class="fas fa-book-open"></i>
                      Baca Selengkapnya
                    </a>
                  </div>
                </div>
              @endforeach

              <!-- Pagination -->
              <div class="pagination-wrapper">
                {{ $wartaGereja->links() }}
              </div>
            @else
              <div class="no-warta">
                <i class="fas fa-newspaper"></i>
                <h4>Belum Ada Warta Gereja</h4>
                <p>Saat ini belum ada warta gereja yang dipublikasikan. Silakan kembali lagi nanti.</p>
              </div>
            @endif
          </div>
        </div>

      </div>
    </section><!-- End Warta Gereja Section -->

  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">GPI Sidang Perawang</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jl. Raya Perawang No. 123</p>
            <p>Perawang, Siak, Riau</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62 812 3456 7890</span></p>
            <p><strong>Email:</strong> <span>info@gpidenominationperawang.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Menu Utama</h4>
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('tentangGereja') }}">Tentang Gereja</a></li>
            <li><a href="{{ route('strukturGereja') }}">Struktur Gereja</a></li>
            <li><a href="{{ route('jadwalPelayanan') }}">Jadwal Pelayanan</a></li>
            <li><a href="{{ route('pendaftaranIbadah') }}">Pendaftaran Ibadah</a></li>
            <li><a href="{{ route('wartaGerejaLanding') }}">Warta Gereja</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Layanan</h4>
          <ul>
            <li><a href="#">Ibadah Minggu</a></li>
            <li><a href="#">Ibadah Doa</a></li>
            <li><a href="#">Sekolah Minggu</a></li>
            <li><a href="#">Persekutuan Remaja</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Newsletter</h4>
          <p>Berlangganan newsletter kami untuk mendapat informasi terbaru tentang kegiatan gereja</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
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
