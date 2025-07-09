<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('assets/img/favicon.ico') }}" alt="logo gpi" class="img-fluid">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="/" class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('tentangGereja') }}" class="{{ Route::currentRouteName() == 'tentangGereja' ? 'active' : '' }}">Tentang Gereja</a></li>
            <li><a href="{{ route('strukturGereja') }}" class="{{ Route::currentRouteName() == 'strukturGereja' ? 'active' : '' }}">Struktur Gereja</a></li>
            <li><a href="{{ route('jadwalPelayanan') }}" class="{{ Route::currentRouteName() == 'jadwalPelayanan' ? 'active' : '' }}">Jadwal Pelayanan</a></li>
            <li><a href="{{ route('pendaftaranIbadah') }}" class="{{ Route::currentRouteName() == 'pendaftaranIbadah' ? 'active' : '' }}">Pendaftaran Ibadah</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    @if(Auth::check())
        <div class="d-flex align-items-center">
            <span class="me-3">{{ Auth::user()->name }}</span>
            @if(Auth::user()->id == 1)
                <a class="btn-getstarted me-2" href="{{ route('dashboard') }}">Dashboard</a>
            @endif
            <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    @else
        <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
    @endif

    </div>
  </header>
