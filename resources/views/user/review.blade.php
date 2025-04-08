@extends('layout.user.template')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('assets/user/images/bg_3.jpg')}}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Beranda <i class="ion-ios-arrow-forward"></i></a></span> <span>Ulasan <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">Ulasan</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section contact-section">
    <div class="container">
      <h2 class="text-center">Beri Ulasan</h2>
  
      @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif
  
      <form action="{{ route('review.store') }}" method="POST">
          @csrf
          <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required>
              @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
  
          <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
              @error('email') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
  
          <div class="mb-3">
              <label for="telepon" class="form-label">Nomor Telepon</label>
              <input type="text" class="form-control" id="telepon" name="telepon" required>
          </div>
  
          <div class="mb-3">
              <label for="pesan" class="form-label">Pesan</label>
              <textarea class="form-control" id="pesan" name="pesan" rows="3" required></textarea>
          </div>
  
          <div class="mb-3">
              <label for="rating" class="form-label">Rating</label>
              <select class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                  <option value="5">⭐⭐⭐⭐⭐ - Sangat Baik</option>
                  <option value="4">⭐⭐⭐⭐ - Baik</option>
                  <option value="3">⭐⭐⭐ - Cukup</option>
                  <option value="2">⭐⭐ - Kurang</option>
                  <option value="1">⭐ - Buruk</option>
              </select>
              @error('rating') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
  
          <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
      </form>
  </div>
  </section>
  
  @endsection