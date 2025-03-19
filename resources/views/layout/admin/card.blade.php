<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Transaksi</p>
                    <h6 class="mb-0">{{ number_format($transaksi, 0, ',', '.') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-car fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Mobil</p>
                    <h6 class="mb-0">{{ $mobil }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">User</p>
                    <h6 class="mb-0">{{ $user }}</h6>
                </div>
            </div>
        </div>

        {{-- Hanya tampil untuk Admin --}}
        @if (Auth::user()->role == 'admin')
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="far fa-envelope fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Pesan</p>
                        <h6 class="mb-0">{{ $kontak }}</h6>
                    </div>
                </div>
            </div>
        @endif

        {{-- Hanya tampil untuk Pemilik --}}
        @if (Auth::user()->role == 'pemilik')
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="far fa-comments fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Ulasan</p>
                        <h6 class="mb-0">{{ $ulasan }}</h6>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
