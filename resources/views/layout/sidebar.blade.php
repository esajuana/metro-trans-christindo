<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ route('home') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>RENT CART</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('assets/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                <span>{{ auth()->user()->role }}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <!-- Menu Dashboard (Bisa diakses oleh semua user) -->
            <a href="{{ route('home') }}" class="nav-item nav-link {{ Request::routeIs('home') ? 'nav-link active ' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            <!-- Menu untuk Pemilik -->
            @if(auth()->user()->role === 'pemilik')
                <a href="{{ route('laporan.transaksi') }}" class="nav-item nav-link {{ Request::routeIs('laporan.*') ? 'nav-link active' : '' }}">
                    <i class="fas fa-file-alt me-2"></i>Laporan Transaksi
                </a>  
                <a href="{{ route('users.index') }}" class="nav-item nav-link {{ Request::routeIs('users.*') ? 'nav-link active ' : '' }}">
                    <i class="fas fa-users me-2"></i>User
                </a>
            @endif

            <!-- Menu untuk Admin -->
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('transaksi.index') }}" class="nav-item nav-link {{ Request::routeIs('transaksi.*') ? 'nav-link active ' : '' }}">
                    <i class="fas fa-shopping-cart me-2"></i>Transaksi
                </a>
                <a href="{{ route('mobils.index') }}" class="nav-item nav-link {{ Request::routeIs('mobils.*') ? 'nav-link active ' : '' }}">
                    <i class="fas fa-car me-2"></i>Mobil
                </a>
            @endif
        </div>
    </nav>
</div>
<!-- Sidebar End -->
