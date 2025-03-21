@extends('layout.user.template')

@section('content')
<div class="hero-wrap ftco-degree-bg" style="background-image: url('{{ asset('assets/user/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
        <div class="col-lg-8 ftco-animate">
        </div>
      </div>
    </div>
  </div>

   <section class="ftco-section ftco-no-pt bg-light">
      <div class="container">
          <div class="row no-gutters">
              <div class="col-md-12	featured-top">
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="services-wrap rounded-right w-100">
                                <h3 class="heading-section mb-4">Cara Terbaik Untuk Menyewa Mobil Impian Anda</h3>
                                <div class="row d-flex mb-4">
                            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                              <div class="services w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                                <div class="text w-100">
                                  <h3 class="heading mb-2">Pilih Lokasi Penjemputan Anda</h3>
                              </div>
                              </div>      
                            </div>
                            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                              <div class="services w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
                                <div class="text w-100">
                                  <h3 class="heading mb-2">Pilih Penawaran Terbaik</h3>
                                </div>
                              </div>      
                            </div>
                            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                              <div class="services w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
                                <div class="text w-100">
                                  <h3 class="heading mb-2">Pesan Mobil Anda</h3>
                                </div>
                              </div>      
                            </div>
                          </div>
                          <p><a href="{{ route('cars')}}" class="btn btn-primary py-3 px-4">Pesan Mobil Anda</a></p>
                            </div>
                        </div>
                    </div>
              </div>
        </div>
  </section>


  <section class="ftco-section ftco-no-pt bg-light">
      <div class="container">
          <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
            <span class="subheading">Apa Yang Kami Tawarkan</span>
          <h2 class="mb-2">Berbagai Jenis Mobil</h2>
        </div>
      </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="carousel-car owl-carousel">
                    @forelse ($mobils as $data)
                      <div class="item">
                          <div class="car-wrap rounded ftco-animate">
                              <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('storage/' . $data->foto) }}');">
                              </div>
                              <div class="text">
                                  <h2 class="mb-0"><a href="#">{{ $data->merk }}</a></h2>

                                  {{-- Menampilkan kategori dengan format yang lebih user-friendly --}}
                                  <div class="d-flex mb-12">
                                      <p class="price">
                                          {{ $data->kategori == 'INCLUDE_DRIVER' ? 'Include Driver' : 'Self Drive' }}
                                      </p>
                                  </div>

                                  {{-- Menampilkan harga sesuai kategori --}}
                                  <div class="d-flex mb-12">
                                      <p class="price mb-2">
                                          {{ number_format($data->harga, 0, ',', '.') }}
                                          {{ $data->kategori == 'INCLUDE_DRIVER' ? '/ 12 jam' : '/ hari' }}
                                      </p>
                                  </div>

                                  <p class="d-flex mb-0 d-block">
                                      <a href="#" class="btn btn-primary py-2 mr-1">Pesan Mobil</a> 
                                      <a href="#" class="btn btn-secondary py-2 ml-1">Detail</a>
                                  </p>
                              </div>
                          </div>
                      </div>
                  @empty
                      <p class="text-center">Belum ada mobil tersedia.</p>
                  @endforelse                                           
                  </div>
              </div>
          </div>
      </div>
  </section>

  <section class="ftco-section ftco-about">
          <div class="container">
              <div class="row no-gutters">
                  <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url({{ asset('assets/user/images/about.jpg')}});">
                  </div>
                  <div class="col-md-6 wrap-about ftco-animate">
            <div class="heading-section heading-section-white pl-md-5">
                <span class="subheading">Tentang Kami</span>
              <h2 class="mb-4">Selamat Datang Di Metro Trans Christindo</h2>

              <p>Metro Trans Christindo adalah perusahaan penyedia layanan rental mobil profesional di Bali yang berkomitmen untuk memberikan pengalaman perjalanan yang nyaman, aman, dan terpercaya. Kami melayani berbagai kebutuhan transportasi, baik untuk keperluan wisata, bisnis, maupun perjalanan pribadi.</p>
              <p>Dengan visi menjadi penyedia layanan transportasi terkemuka di Bali, kami selalu mengutamakan kualitas, keamanan, dan kepuasan pelanggan. Misi kami adalah menyediakan armada kendaraan yang terawat, memberikan layanan pelanggan yang ramah dan profesional, menawarkan harga sewa yang kompetitif dan transparan, serta menjamin kenyamanan dan keselamatan pelanggan dalam setiap perjalanan.</p>
              <p><a href="#" class="btn btn-primary py-3 px-4">Cari Mobil</a></p>
            </div>
                  </div>
              </div>
          </div>
      </section>

      <section class="ftco-section">
          <div class="container">
              <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">Layanan</span>
          <h2 class="mb-3">Layanan Terbaru Kami</h2>
        </div>
      </div>
              <div class="row">
                  <div class="col-md-3">
                      <div class="services services-2 w-100 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-wedding-car"></span></div>
              <div class="text w-100">
              <h3 class="heading mb-2">Pernikahan</h3>
              <p>Kami menyediakan layanan transportasi untuk acara pernikahan, memastikan perjalanan yang nyaman dan elegan di hari spesial Anda.</p>
            </div>
          </div>
                  </div>
                  <div class="col-md-3">
                      <div class="services services-2 w-100 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
              <div class="text w-100">
              <h3 class="heading mb-2">Transportasi Antar Kota</h3>
              <p>Nikmati perjalanan yang nyaman dan aman dengan layanan transportasi antar kota kami yang profesional dan tepat waktu.</p>
            </div>
          </div>
                  </div>
                  <div class="col-md-3">
                      <div class="services services-2 w-100 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
              <div class="text w-100">
                <h3 class="heading mb-2">Antar Jemput Bandara</h3>
                <p>Kami menawarkan layanan antar jemput bandara yang nyaman dan efisien untuk memudahkan perjalanan Anda dari dan ke bandara.</p>
            </div>
          </div>
                  </div>
                  <div class="col-md-3">
                      <div class="services services-2 w-100 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
              <div class="text w-100">
                <h3 class="heading mb-2">Tur Keliling Kota</h3>
                <p>Jelajahi keindahan kota dengan layanan tur kami yang menawarkan pengalaman perjalanan yang menyenangkan dan informatif.</p>
            </div>
          </div>
                  </div>
              </div>
          </div>
      </section>

      <section class="ftco-section testimony-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Testimoni</span>
                    <h2 class="mb-3">Ulasan</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        @forelse ($reviews as $review)
                        <div class="item">
                            <div class="testimony-wrap rounded text-center py-4 pb-5">
                                <div class="text pt-4">
                                    <p class="mb-4">"{{ $review->pesan }}"</p>
                                    <p class="name">{{ $review->nama }}</p>
                                    <div class="rating">
                                      @for ($i = 1; $i <= 5; $i++)
                                          @if ($i <= $review->rating)
                                              <i class="fas fa-star text-warning"></i>  {{-- Bintang penuh --}}
                                          @else
                                              <i class="far fa-star text-warning"></i>  {{-- Bintang kosong --}}
                                          @endif
                                      @endfor
                                  </div>                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center">
                            <p>Belum ada ulasan yang dipublikasikan.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection