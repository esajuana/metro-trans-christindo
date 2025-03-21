@extends('layout.user.template')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('assets/user/images/bg_3.jpg')}}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Beranda <i class="ion-ios-arrow-forward"></i></a></span> <span>Kontak <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">Kontak Kami</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section contact-section">
    <div class="container">
      <div class="row d-flex mb-5 contact-info">
        <div class="col-md-4">
          <div class="row mb-5">
            <div class="col-md-12">
              <div class="border w-100 p-4 rounded mb-2 d-flex">
                <div class="icon mr-3">
                  <span class="icon-map-o"></span>
                </div>
                <p><span>Alamat:</span> LINGK. DELOD PEMPATAN, Lukluk, Kec. Mengwi, Kabupaten Badung, Bali 80351</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="border w-100 p-4 rounded mb-2 d-flex">
                <div class="icon mr-3">
                  <span class="icon-mobile-phone"></span>
                </div>
                <p><span>Telepon:</span> <a href="tel://1234567920">+62 812-3997-2887</a></p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="border w-100 p-4 rounded mb-2 d-flex">
                <div class="icon mr-3">
                  <span class="icon-envelope-o"></span>
                </div>
                <p><span>Email:</span> <a href="mailto:info@yoursite.com">metrotranschristindo@gmail.com</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8 block-9 mb-md-5">
          @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif

          <form action="{{ route('contact.store') }}" method="POST" class="bg-light p-5 contact-form">
            @csrf
            <div class="form-group">
                <input type="text" name="nama" class="form-control" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="text" name="telepon" class="form-control" placeholder="Nomer Telepon">
            </div>
            <div class="form-group">
                <textarea name="pesan" cols="30" rows="7" class="form-control" placeholder="Pesan" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Kirim Pesan" class="btn btn-primary py-3 px-5">
            </div>
        </form>        
        </div>
      </div>
    
  </section>
  @endsection