@extends('layout.user.template')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('assets/user/images/bg_3.jpg')}}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Beranda <i class="ion-ios-arrow-forward"></i></a></span> <span>Tentang Kami <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">Tentang Kami</h1>
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