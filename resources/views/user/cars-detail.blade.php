@extends('layout.user.template')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('assets/user/images/bg_3.jpg')}}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> 
                    <span><a href="{{ route('cars') }}">Cars <i class="ion-ios-arrow-forward"></i></a></span> 
                    <span>{{ $car->merk }}</span>
                </p>
                <h1 class="mb-3 bread">Detail Mobil</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $car->foto) }}" class="img-fluid rounded" alt="{{ $car->merk }}">
            </div>
            <div class="col-md-6">
                <h2>{{ $car->merk }}</h2>
                <p><strong>Kategori:</strong> {{ $car->kategori == 'INCLUDE_DRIVER' ? 'Include Driver' : 'Self Drive' }}</p>
                <p><strong>Harga:</strong> Rp{{ number_format($car->harga, 0, ',', '.') }} {{ $car->kategori == 'INCLUDE_DRIVER' ? '/ 12 jam' : '/ hari' }}</p>
                <p><strong>Kapasitas:</strong> {{ $car->kapasitas }} Seat</p>
                <a href="#" class="btn btn-primary py-2">Pesan Sekarang</a>
            </div>
        </div>
    </div>
</section>
@endsection
