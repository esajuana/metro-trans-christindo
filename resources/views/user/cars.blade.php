@extends('layout.user.template')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('assets/user/images/bg_3.jpg')}}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Beranda <i class="ion-ios-arrow-forward"></i></a></span> <span>Sewa Mobil <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">Pilih Mobil Anda</h1>
        </div>
      </div>
    </div>
  </section>
      

      <section class="ftco-section bg-light">
      <div class="container">
          <div class="row">
            @forelse ($cars as $data)
              <div class="col-md-4">
                  <div class="car-wrap rounded ftco-animate">
                      <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('storage/' . $data->foto) }}');">
                      </div>
                      <div class="text">
                          <h2 class="mb-0"><a href="car-single.html">{{ $data->merk }}</a></h2>
                          <div class="d-flex mb-12">
                            <p class="price">
                                {{ $data->kategori == 'INCLUDE_DRIVER' ? 'Include Driver' : 'Self Drive' }}
                            </p>
                         </div>
                         <div class="d-flex mb-12">
                          <p class="price mb-2">
                              {{ number_format($data->harga, 0, ',', '.') }}
                              {{ $data->kategori == 'INCLUDE_DRIVER' ? '/ 12 jam' : '/ hari' }}
                          </p>
                      </div>
                          <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Pesan</a> <a href="{{ route('cars.show', $data->id) }}" class="btn btn-secondary py-2 ml-1">Detail</a>
                          </p>
                      </div>
                  </div>
              </div>
              @empty
              <p class="text-center">Data Mobil Belum Ada</p>
               @endforelse
          </div>
          <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $cars->links('pagination::bootstrap-4') }}
            </div>
        </div>
      </div>
  </section>
@endsection