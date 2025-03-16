<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html">Metro<span> Trans Christindo</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">Beranda</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('cars') }}" class="nav-link {{ Request::routeIs('cars') ? 'active' : '' }}">Sewa Mobil</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('about') }}" class="nav-link {{ Request::routeIs('about') ? 'active' : '' }}">Tentang Kami</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('contact') }}" class="nav-link {{ Request::routeIs('contact') ? 'active' : '' }}">Kontak</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('review') }}" class="nav-link {{ Request::routeIs('review') ? 'active' : '' }}">Ulasan</a>
            </li>
        </ul>
    </div>
    
    </div>
  </nav>
<!-- END nav -->