<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{!! strip_tags($warta->nama_warta) !!} - GPI Sidang Perawang</title>
  <meta name="description" content="Detail Warta Gereja {!! strip_tags($warta->nama_warta) !!}">
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
    .detail-container {
      background: #f8f9fa;
      padding: 60px 0;
      min-height: 100vh;
    }

    .warta-detail {
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .warta-header {
      background: linear-gradient(135deg, #2c4964 0%, #34495e 100%);
      color: white;
      padding: 40px;
      text-align: center;
    }

    .warta-title {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      line-height: 1.2;
    }

    .warta-meta {
      display: flex;
      justify-content: center;
      gap: 30px;
      flex-wrap: wrap;
      opacity: 0.9;
    }

    .meta-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.95rem;
    }

    .warta-content {
      padding: 50px;
    }

    .content-text {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #333;
      text-align: justify;
    }

    .content-text p {
      margin-bottom: 20px;
    }

    .content-text h1,
    .content-text h2,
    .content-text h3,
    .content-text h4,
    .content-text h5,
    .content-text h6 {
      color: #2c4964;
      margin-top: 30px;
      margin-bottom: 15px;
      font-weight: 600;
    }

    .content-text ul,
    .content-text ol {
      margin-bottom: 20px;
      padding-left: 30px;
    }

    .content-text li {
      margin-bottom: 8px;
    }

    .content-text blockquote {
      background: #f8f9fa;
      border-left: 4px solid #ff6b35;
      padding: 20px;
      margin: 25px 0;
      font-style: italic;
      border-radius: 0 8px 8px 0;
    }

    .back-button {
      background: linear-gradient(45deg, #ff6b35, #f93d00);
      color: white;
      border: none;
      padding: 12px 25px;
      border-radius: 25px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 30px;
    }

    .back-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
      color: white;
    }

    .share-section {
      background: #f8f9fa;
      padding: 30px;
      border-top: 1px solid #e9ecef;
      text-align: center;
    }

    .share-title {
      color: #2c4964;
      font-weight: 600;
      margin-bottom: 20px;
    }

    .share-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
      flex-wrap: wrap;
    }

    .share-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 20px;
      border-radius: 25px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
      color: white;
    }

    .share-btn:hover {
      transform: translateY(-2px);
      color: white;
    }

    .share-whatsapp {
      background: #25d366;
    }

    .share-whatsapp:hover {
      box-shadow: 0 8px 20px rgba(37, 211, 102, 0.3);
    }

    .share-facebook {
      background: #3b5998;
    }

    .share-facebook:hover {
      box-shadow: 0 8px 20px rgba(59, 89, 152, 0.3);
    }

    .share-twitter {
      background: #1da1f2;
    }

    .share-twitter:hover {
      box-shadow: 0 8px 20px rgba(29, 161, 242, 0.3);
    }

    .share-copy {
      background: #6c757d;
    }

    .share-copy:hover {
      box-shadow: 0 8px 20px rgba(108, 117, 125, 0.3);
    }

    @media (max-width: 768px) {
      .warta-title {
        font-size: 2rem;
      }

      .warta-content {
        padding: 30px 20px;
      }

      .warta-header {
        padding: 30px 20px;
      }

      .warta-meta {
        flex-direction: column;
        gap: 15px;
      }

      .content-text {
        font-size: 1rem;
      }

      .share-buttons {
        flex-direction: column;
        align-items: center;
      }

      .share-btn {
        width: 200px;
        justify-content: center;
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
        <h1>Detail Warta Gereja</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('wartaGerejaLanding') }}">Warta Gereja</a></li>
            <li class="current">{{ \Illuminate\Support\Str::limit(strip_tags($warta->nama_warta), 50) }}</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Warta Detail Section -->
    <section class="detail-container">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">

            <!-- Back Button -->
            <a href="{{ route('wartaGerejaLanding') }}" class="back-button" data-aos="fade-right">
              <i class="fas fa-arrow-left"></i>
              Kembali ke Daftar Warta
            </a>

            <!-- Warta Detail Card -->
            <div class="warta-detail" data-aos="fade-up">

              <!-- Header -->
              <div class="warta-header">
                <h1 class="warta-title text-white">{!! $warta->nama_warta !!}</h1>
                <div class="warta-meta">
                  <div class="meta-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ \Carbon\Carbon::parse($warta->tanggal)->translatedFormat('d F Y') }}</span>
                  </div>
                  <div class="meta-item">
                    <i class="fas fa-user"></i>
                    <span>Admin GPI Perawang</span>
                  </div>
                </div>
              </div>

              <!-- Content -->
              <div class="warta-content">
                <div class="content-text">
                  {!! $warta->warta !!}
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </section><!-- End Warta Detail Section -->

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

  <script>
    function copyToClipboard() {
      const url = window.location.href;
      navigator.clipboard.writeText(url).then(function() {
        // Success
        const btn = document.querySelector('.share-copy');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
        btn.style.background = '#28a745';

        setTimeout(function() {
          btn.innerHTML = originalText;
          btn.style.background = '#6c757d';
        }, 2000);
      }).catch(function(err) {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = url;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);

        const btn = document.querySelector('.share-copy');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
        btn.style.background = '#28a745';

        setTimeout(function() {
          btn.innerHTML = originalText;
          btn.style.background = '#6c757d';
        }, 2000);
      });
    }
  </script>

</body>

</html>
