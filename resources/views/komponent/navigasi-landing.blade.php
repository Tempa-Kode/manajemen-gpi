<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="/" class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('tentangGereja') }}" class="{{ Route::currentRouteName() == 'tentangGereja' ? 'active' : '' }}">Tentang Gereja</a></li>
        <li><a href="{{ route('jadwalPelayanan') }}">Jadwal Pelayanan</a></li>
        <li><a href="#services">Pendaftaran Ibadah</a></li>
        <li><a href="#pricing">Struktur Gereja</a></li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>
