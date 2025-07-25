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
        Manajemen GPI - Login
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
                                <h4 class="font-weight-bolder">Login</h4>
                                <p class="mb-0">Inputkan email dan password anda untuk login</p>
                            </div>
                            <div class="card-body">
                                {{-- Menampilkan error dari withErrors() --}}
                                @if ($errors->has('message'))
                                    <div class="alert alert-danger text-white" role="alert">
                                        {{ $errors->first('message') }}
                                    </div>
                                @elseif (session('success'))
                                    <div class="alert alert-success text-white" role="alert">
                                        <strong>Berhasil!</strong> {{ session('success') }}
                                    </div>
                                @endif
                                <form action="{{ route('prosesLogin') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3">
                                        <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-4 text-sm mx-auto">
                                    Belum memiliki akun?
                                    <a href="{{ route('daftarTamu') }}" class="text-primary text-gradient font-weight-bold">Daftar Sebagai Tamu</a>
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
