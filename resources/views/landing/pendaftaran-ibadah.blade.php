<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Pendaftaran Ibadah - GPI Sidang Perawang</title>
  <meta name="description" content="Form pendaftaran ibadah GPI Sidang Perawang">
  <meta name="keywords" content="pendaftaran ibadah, gpi perawang">

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
  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

  <style>
    .form-container {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      padding: 40px;
      margin: 30px 0;
    }

    .form-title {
      color: #2c4964;
      font-weight: 700;
      margin-bottom: 30px;
      text-align: center;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      font-weight: 600;
      color: #2c4964;
      margin-bottom: 8px;
    }

    .form-control, .form-select {
      border: 2px solid #e9ecef;
      border-radius: 8px;
      padding: 12px 15px;
      transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
      border-color: #ff6b35;
      box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
    }

    .btn-submit {
      background: linear-gradient(45deg, #ff6b35, #f93d00);
      border: none;
      border-radius: 50px;
      padding: 15px 40px;
      font-weight: 600;
      color: white;
      transition: all 0.3s ease;
      width: 100%;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(255, 107, 53, 0.3);
      color: white;
    }

    .alert {
      border-radius: 10px;
      margin-bottom: 25px;
    }

    .jadwal-info {
      background: #f8f9fa;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 25px;
    }

    .jadwal-item {
      background: white;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 10px;
      border-left: 4px solid #ff6b35;
    }

    .btn-cancel {
      transition: all 0.3s ease;
    }

    .btn-cancel:hover {
      transform: scale(1.1);
    }

    .cancel-disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }

    /* Select2 Custom Styling */
    .select2-container {
      width: 100% !important;
    }

    .select2-container--bootstrap-5 .select2-selection--single {
      border: 2px solid #e9ecef !important;
      border-radius: 8px !important;
      padding: 12px 15px !important;
      height: auto !important;
      min-height: 48px !important;
      font-size: 16px !important;
      transition: all 0.3s ease !important;
    }

    .select2-container--bootstrap-5 .select2-selection--single:focus,
    .select2-container--bootstrap-5.select2-container--focus .select2-selection--single {
      border-color: #ff6b35 !important;
      box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25) !important;
      outline: none !important;
    }

    .select2-container--bootstrap-5 .select2-selection__rendered {
      color: #495057 !important;
      padding-left: 0 !important;
      padding-right: 20px !important;
      line-height: 1.5 !important;
    }

    .select2-container--bootstrap-5 .select2-selection__arrow {
      height: 46px !important;
      right: 15px !important;
    }

    .select2-dropdown {
      border: 2px solid #e9ecef !important;
      border-radius: 8px !important;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .select2-container--bootstrap-5 .select2-results__option {
      padding: 12px 15px !important;
      font-size: 16px !important;
    }

    .select2-container--bootstrap-5 .select2-results__option--highlighted {
      background-color: #ff6b35 !important;
      color: white !important;
    }

    .select2-container--bootstrap-5 .select2-results__option[aria-selected="true"] {
      background-color: #f8f9fa !important;
      color: #495057 !important;
    }

    .select2-search--dropdown .select2-search__field {
      border: 1px solid #e9ecef !important;
      border-radius: 6px !important;
      padding: 8px 12px !important;
      font-size: 14px !important;
    }

    .select2-search--dropdown .select2-search__field:focus {
      border-color: #ff6b35 !important;
      box-shadow: 0 0 0 0.1rem rgba(255, 107, 53, 0.25) !important;
      outline: none !important;
    }

    /* Icon styling for select options */
    .select2-results__option .option-icon {
      margin-right: 8px;
      width: 16px;
      display: inline-block;
    }

    .select2-dropdown-custom {
      animation: fadeInUp 0.3s ease-in-out;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .select2-option-wrapper {
      display: flex;
      align-items: center;
    }

    .option-text {
      font-size: 15px;
      line-height: 1.4;
    }

    /* Custom placeholder styling */
    .select2-container--bootstrap-5 .select2-selection__placeholder {
      color: #6c757d !important;
      font-style: italic;
    }

    /* Make Select2 responsive */
    @media (max-width: 768px) {
      .select2-container--bootstrap-5 .select2-selection--single {
        font-size: 14px !important;
        min-height: 44px !important;
        padding: 10px 12px !important;
      }

      .select2-container--bootstrap-5 .select2-results__option {
        padding: 10px 12px !important;
        font-size: 14px !important;
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
        <h1>Pendaftaran Ibadah</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Pendaftaran Ibadah</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Pendaftaran Ibadah Section -->
    <section id="pendaftaran-ibadah" class="section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">

            <!-- Success/Error Messages -->
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Terdapat kesalahan:</strong>
                <ul class="mb-0 mt-2">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <!-- Pendaftaran Existing (jika user sudah login) -->
            @auth
              @if($pendaftaranExisting->count() > 0)
                <div class="form-container mb-4" data-aos="fade-up">
                  <h3 class="form-title">
                    <i class="fas fa-list-check me-3"></i>
                    Pendaftaran Ibadah Anda
                  </h3>
                  <p class="text-center text-muted mb-4">
                    Berikut adalah daftar ibadah yang sudah Anda daftarkan untuk hari-hari mendatang
                  </p>

                  @foreach($pendaftaranExisting as $pendaftaran)
                    <div class="jadwal-item">
                      <div class="row align-items-center">
                        <div class="col-md-2">
                          <strong>{{ $pendaftaran->jadwalIbadah->jenisIbadah->jenis_ibadah }}</strong>
                        </div>
                        <div class="col-md-4">
                          <i class="fas fa-calendar me-1"></i>
                          {{ \Carbon\Carbon::parse($pendaftaran->jadwalIbadah->tanggal)->translatedFormat('d M Y') }}
                        </div>
                        <div class="col-md-2">
                          <i class="fas fa-clock me-1"></i>
                          {{ \Carbon\Carbon::parse($pendaftaran->jadwalIbadah->jam)->format('H:i') }}
                        </div>
                        <div class="col-md-2">
                          <small class="text-muted">
                            {{ \Carbon\Carbon::parse($pendaftaran->created_at)->diffForHumans() }}
                          </small>
                        </div>
                        <div class="col-md-2">
                          @php
                            $tanggalIbadah = \Carbon\Carbon::parse($pendaftaran->jadwalIbadah->tanggal);
                            $jamIbadah = \Carbon\Carbon::parse($pendaftaran->jadwalIbadah->jam);

                            // Gabungkan tanggal dan jam ibadah
                            $waktuIbadah = $tanggalIbadah->setTimeFromTimeString($jamIbadah->format('H:i:s'));

                            // Batas waktu pembatalan: 1 hari (24 jam) sebelum ibadah
                            $batasWaktu = $waktuIbadah->copy()->subHours(24);

                            $masihBisaDibatalkan = \Carbon\Carbon::now()->lessThan($batasWaktu);
                          @endphp

                          @if($masihBisaDibatalkan)
                            <form action="{{ route('pendaftaranIbadah.cancel', $pendaftaran->id) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pendaftaran ini?')"
                                  style="display: inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-outline-danger btn-cancel"
                                      title="Batalkan Pendaftaran (Batas: {{ $batasWaktu->translatedFormat('d M Y, H:i') }})" data-bs-toggle="tooltip">
                                <i class="fas fa-times"></i>
                              </button>
                            </form>
                          @else
                            <span class="badge bg-secondary cancel-disabled"
                                  title="Tidak dapat dibatalkan - Sudah melewati batas waktu H-1 ({{ $batasWaktu->translatedFormat('d M Y, H:i') }})"
                                  data-bs-toggle="tooltip">
                              <i class="fas fa-lock"></i>
                            </span>
                          @endif
                        </div>
                      </div>
                      @if($pendaftaran->keterangan)
                        <div class="row mt-2">
                          <div class="col-12">
                            <small class="text-muted">
                              <i class="fas fa-comment me-1"></i>
                              {{ $pendaftaran->keterangan }}
                            </small>
                          </div>
                        </div>
                      @endif

                      <!-- Info batas waktu pembatalan -->
                      <div class="row mt-2">
                        <div class="col-12">
                          <small class="text-muted">
                            @if($masihBisaDibatalkan)
                              <i class="fas fa-clock text-warning me-1"></i>
                              <span class="text-warning">Dapat dibatalkan sampai: {{ $batasWaktu->translatedFormat('d F Y, H:i') }} WIB</span>
                            @else
                              <i class="fas fa-lock text-danger me-1"></i>
                              <span class="text-danger">Batas pembatalan telah terlewati (H-1)</span>
                            @endif
                          </small>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endif
            @endauth

            <!-- Form Container -->
            <div class="form-container" id="form-pendaftaran" data-aos="fade-up">
              <h2 class="form-title">
                <i class="fas fa-hands-praying me-3"></i>
                Daftar Ibadah
              </h2>

              @guest
                <!-- Pesan untuk user yang belum login -->
                <div class="alert alert-warning text-center">
                  <i class="fas fa-exclamation-triangle me-2"></i>
                  <strong>Anda harus login terlebih dahulu untuk mendaftar ibadah.</strong>
                  <hr>
                  <div class="mt-3">
                    <a href="{{ route('login') }}" class="btn btn-primary me-2">
                      <i class="fas fa-sign-in-alt me-1"></i>
                      Login
                    </a>
                    <a href="{{ route('daftarTamu') }}" class="btn btn-outline-secondary">
                      <i class="fas fa-user-plus me-1"></i>
                      Daftar Akun
                    </a>
                  </div>
                </div>
              @else
                <p class="text-center text-muted mb-4">
                  Selamat datang <strong>{{ Auth::user()->name }}</strong>! Silakan lengkapi formulir di bawah ini untuk mendaftar ibadah.
                </p>
              @endguest

              <!-- Info Jadwal Tersedia -->
              @auth
              @if($jadwalIbadah->count() > 0)
                <div class="jadwal-info">
                  <h5 class="mb-3"><i class="fas fa-calendar-alt me-2"></i>Jadwal Ibadah Tersedia</h5>
                  @foreach($jadwalIbadah->take(3) as $jadwal)
                    <div class="jadwal-item">
                      <div class="row align-items-center">
                        <div class="col-md-4">
                          <strong>{{ $jadwal->jenisIbadah->jenis_ibadah }}</strong>
                        </div>
                        <div class="col-md-4">
                          <i class="fas fa-calendar me-1"></i>
                          {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') }}
                        </div>
                        <div class="col-md-4">
                          <i class="fas fa-clock me-1"></i>
                          {{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }} WIB
                        </div>
                      </div>
                    </div>
                  @endforeach
                  @if($jadwalIbadah->count() > 3)
                    <p class="text-muted mb-0 mt-2">
                      <i class="fas fa-info-circle me-1"></i>
                      Dan {{ $jadwalIbadah->count() - 3 }} jadwal lainnya tersedia untuk dipilih.
                    </p>
                  @endif
                </div>
              @endif

              <!-- Form Pendaftaran -->
              <form action="{{ route('pendaftaranIbadah.store') }}" method="POST">
                @csrf

                <div class="form-group">
                  <label for="jadwal_ibadah_id" class="form-label">
                    <i class="fas fa-calendar-check me-1"></i>
                    Pilih Jadwal Ibadah <span class="text-danger">*</span>
                  </label>
                  <select class="form-select select2-jadwal" id="jadwal_ibadah_id" name="jadwal_ibadah_id" required>
                    <option value="">Pilih Jadwal Ibadah</option>
                    @foreach($jadwalIbadah as $jadwal)
                      <option value="{{ $jadwal->id }}" {{ old('jadwal_ibadah_id') == $jadwal->id ? 'selected' : '' }}
                              data-tanggal="{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') }}"
                              data-jam="{{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }}"
                              data-lokasi="{{ $jadwal->lokasi }}">
                        📅 {{ $jadwal->jenisIbadah->jenis_ibadah }} -
                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') }}
                        🕐 {{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }} WIB
                        @if($jadwal->lokasi)
                          📍 {{ $jadwal->lokasi }}
                        @endif
                      </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="keterangan" class="form-label">
                    <i class="fas fa-comment me-1"></i>
                    Keterangan Tambahan
                  </label>
                  <textarea class="form-control" id="keterangan" name="keterangan" rows="4" placeholder="Tuliskan keterangan tambahan jika ada...">{{ old('keterangan') }}</textarea>
                  <small class="form-text text-muted">Opsional - maksimal 500 karakter</small>
                </div>

                <div class="text-center mt-4">
                  <button type="submit" class="btn btn-submit">
                    <i class="fas fa-paper-plane me-2"></i>
                    Daftar Ibadah
                  </button>
                </div>
              </form>
              @endauth

            </div>
          </div>
        </div>

        <!-- Info Section -->
        <div class="row mt-5">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
            <div class="alert alert-info">
              <h5 class="alert-heading">
                <i class="fas fa-info-circle me-2"></i>
                Informasi Penting
              </h5>
              <hr>
              <ul class="mb-0">
                <li>Anda harus login terlebih dahulu untuk dapat mendaftar ibadah</li>
                <li>Pendaftaran akan menggunakan nama dan email dari akun Anda</li>
                <li>Konfirmasi pendaftaran akan dikirim melalui email atau WhatsApp</li>
                <li><strong>Pembatalan pendaftaran dapat dilakukan maksimal 1 hari sebelum ibadah</strong></li>
                <li>Setelah batas waktu pembatalan, pendaftaran tidak dapat dibatalkan</li>
                <li>Untuk pertanyaan lebih lanjut, hubungi sekretariat gereja</li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Pendaftaran Ibadah Section -->

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
  <script src="{{ asset('landing/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>  <!-- Main JS File -->
  <script src="{{ asset('landing/assets/js/main.js') }}"></script>

  <!-- jQuery (required for Select2) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <!-- Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  <script>
    $(document).ready(function() {
      // Initialize tooltips
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });

      // Initialize Select2 untuk Jadwal Ibadah
      $('.select2-jadwal').select2({
        theme: 'bootstrap-5',
        placeholder: 'Pilih Jadwal Ibadah yang Ingin Diikuti',
        allowClear: false,
        width: '100%',
        dropdownParent: $('.select2-jadwal').parent(),
        templateResult: function(option) {
          if (!option.id) return option.text;

          // Parse data dari option
          var text = option.text;
          var $option = $('<div class="select2-option-wrapper"><div class="option-text">' + text + '</div></div>');
          return $option;
        }
      });

      // Add custom class when dropdown opens
      $('.select2-jadwal').on('select2:open', function() {
        setTimeout(function() {
          $('.select2-dropdown').addClass('select2-dropdown-custom');
        }, 1);
      });

      // Ensure Select2 works with form validation
      $('.select2-jadwal').on('select2:select', function() {
        $(this).trigger('change');
      });
    });
  </script>

</body>

</html>
