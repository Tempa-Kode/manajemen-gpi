<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Struktur Gereja - GPI Sidang Perawang</title>
  <meta name="description" content="Struktur organisasi GPI Sidang Perawang">
  <meta name="keywords" content="struktur gereja, organisasi, gpi perawang, pengurus gereja">

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
    .structure-container {
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

    .org-chart {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      margin: 50px 0;
      position: relative;
    }

    .org-level {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 40px 0;
      position: relative;
    }

    .org-level-1 {
      margin-bottom: 60px;
    }

    .org-level-2 {
      justify-content: space-around;
      margin: 60px 0;
    }

    .org-level-3 {
      justify-content: space-between;
      margin-top: 60px;
    }

    .org-box {
      background: white;
      border: 3px solid #333;
      border-radius: 8px;
      padding: 20px;
      text-align: center;
      font-size: 14px;
      font-weight: 600;
      color: #333;
      min-width: 180px;
      max-width: 220px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      position: relative;
      z-index: 2;
    }

    .org-box h5 {
      margin: 0 0 15px 0;
      font-size: 16px;
      font-weight: 700;
      text-transform: uppercase;
      text-decoration: underline;
      color: #333;
    }

    .org-box p {
      margin: 5px 0;
      font-size: 13px;
      line-height: 1.4;
      color: #333;
    }

    .org-box p strong {
      text-decoration: underline;
      font-weight: 600;
    }

    /* Garis vertikal dari level 1 ke level 2 */
    .org-level-1::after {
      content: '';
      position: absolute;
      bottom: -30px;
      left: 50%;
      transform: translateX(-50%);
      width: 3px;
      height: 30px;
      background: #333;
    }

    /* Garis horizontal di level 2 */
    .org-level-2::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 30%;
      right: 30%;
      height: 3px;
      background: #333;
      transform: translateY(-50%);
    }

    /* Garis vertikal dari level 2 ke level 3 */
    .org-level-2::after {
      content: '';
      position: absolute;
      bottom: -30px;
      left: 50%;
      transform: translateX(-50%);
      width: 3px;
      height: 30px;
      background: #333;
    }

    /* Garis horizontal di level 3 */
    .org-level-3::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 10%;
      right: 10%;
      height: 3px;
      background: #333;
      transform: translateY(-50%);
    }

    /* Garis vertikal langsung dari gembala sidang ke pemuda */
    .org-chart::after {
      content: '';
      position: absolute;
      top: 170px;
      left: 50%;
      transform: translateX(-50%);
      width: 3px;
      height: 290px;
      background: #333;
      z-index: 1;
    }

    .info-card {
      background: white;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      margin: 40px 0;
    }

    .info-card h4 {
      color: #2c4964;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .info-card p {
      color: #666;
      line-height: 1.7;
    }

    @media (max-width: 768px) {
      .org-level-2,
      .org-level-3 {
        flex-direction: column;
        gap: 20px;
      }

      .org-level-2::before,
      .org-level-3::before {
        display: none;
      }

      .org-box {
        min-width: 160px;
        max-width: 180px;
      }
    }
  </style>
</head>

<body class="starter-page-page">

  @include('komponent.navigasi-landing')

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <h1>Struktur Gereja</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Struktur Gereja</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Structure Section -->
    <section class="structure-container">
      <div class="container">

        <!-- Organizational Chart -->
        <div class="row" data-aos="fade-up">
          <div class="col-12">
            <div class="org-chart">

              <!-- Level 1: Gembala Sidang -->
              <div class="org-level org-level-1">
                <div class="org-box">
                  <h5>Gembala Sidang</h5>
                  <p>Pdt. S Gultom</p>
                </div>
              </div>

              <!-- Level 2: Bendahara dan Penatua -->
              <div class="org-level org-level-2">
                <div class="org-box">
                  <h5>Bendahara</h5>
                  <p>Norista Sitinjak</p>
                </div>
                <div class="org-box">
                  <h5>Penatua</h5>
                  <p>Gr. H. Tinambunan</p>
                  <p>Gr. B. Lumban Raja</p>
                  <p>St. J. Pasaribu</p>
                </div>
              </div>

              <!-- Level 3: Departemen -->
              <div class="org-level org-level-3">
                <div class="org-box">
                  <h5>Kaum Ibu</h5>
                  <p><strong>Pembina</strong></p>
                  <p>Ibu Pdt. R Sinaga</p>
                  <p><strong>Ketua</strong></p>
                  <p>Mesra Br. Simbolon</p>
                  <p><strong>Bendahara</strong></p>
                  <p>Lina Br. Mangusong</p>
                </div>
                <div class="org-box">
                  <h5>Pemuda/i</h5>
                  <p><strong>Pembina</strong></p>
                  <p>Gr. B. Lumban Raja</p>
                  <p><strong>Ketua</strong></p>
                  <p>Lia Hutagaol</p>
                </div>
                <div class="org-box">
                  <h5>Sekolah Minggu</h5>
                  <p><strong>Guru Sekolah Minggu</strong></p>
                  <p>Gunawan Br. Sinaga</p>
                  <p>Ronni Br. Situmorang</p>
                  <p>Ibu Reza Sigalingging</p>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
    </section><!-- End Structure Section -->

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
