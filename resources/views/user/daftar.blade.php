<!--
=========================================================
* Argon Dashboard 3 - v2.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png' ) }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico' ) }}">
    <title>
        Manajemen GPI - Daftar Tamu
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css' ) }}?v=2.1.0" rel="stylesheet" />
</head>

<body class="">
<main class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">Daftar Sebagai Tamu</h4>
                                <p class="mb-0">masukan data anda dengan sesuai</p>
                            </div>
                            <div class="card-body">
                                {{-- Menampilkan error dari withErrors() --}}
                                @if ($errors->has('message'))
                                    <div class="alert alert-danger text-white" role="alert">
                                        {{ $errors->first('message') }}
                                    </div>
                                 @elseif (session('message'))
                                    <div class="alert alert-warning text-white" role="alert">
                                        <strong>Peringatan!</strong> {{ session('message') }}
                                    </div>
                                @endif

                                <form action="{{ route('daftarTamu.store') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-lg" placeholder="Nama" aria-label="Nama" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="text-danger fs-6 fst-italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" name="username" value="{{ old('username') }}" required>
                                        @error('username')
                                            <span class="text-danger fs-6 fst-italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="text-danger fs-6 fst-italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password" value="{{ old('password') }}" required>
                                        @error('password')
                                            <span class="text-danger fs-6 fst-italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control form-control-lg" placeholder="Konfirmasi Password" aria-label="Konfirmasi Password" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                        @error('password_confirmation')
                                            <span class="text-danger fs-6 fst-italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" class="form-control form-control-lg" placeholder="No Telp" aria-label="No Telp" name="no_telp" value="{{ old('no_telp') }}" required>
                                        @error('no_telp')
                                            <span class="text-danger fs-6 fst-italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-control-label">Jenis Kelamin</label>
                                        <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="laki-laki">Laki-Laki</label>
                                        </div>
                                        <div class="form-check ms-3">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                        @error('jenis_kelamin')
                                            <span class="text-danger fs-6 fst-italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="">
                                        <input type="text" class="form-control form-control-lg" placeholder="Alamat" aria-label="Alamat" name="alamat" value="{{ old('alamat') }}" required>
                                        @error('alamat')
                                            <span class="text-danger fs-6 fst-italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Daftar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-4 text-sm mx-auto">
                                    Sudah memiliki akun?
                                    <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Login</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg' ) }}'); background-size: cover;">
                            {{-- <span class="mask bg-gradient-primary opacity-6"></span> --}}
                            <img src="{{ asset('assets/img/logo-gpi-hero.png') }}" alt="">
                            <h4 class="mt-5 text-white font-weight-bolder position-relative">"Gereja Pentakosta Indonesia Sidang Perawang"</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/popper.min.js' ) }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js' ) }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js' ) }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js' ) }}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js' ) }}"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/argon-dashboard.min.js' ) }}?v=2.1.0"></script>
</body>

</html>
