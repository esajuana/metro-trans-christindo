<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Metro Trans Christindo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/user/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/animate.css')}}">
    
    <link rel="stylesheet" href="{{ asset('assets/user/css/owl.carousel.min.cs')}}s">
    <link rel="stylesheet" href="{{ asset('assets/user/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/user/css/aos.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/user/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/jquery.timepicker.css')}}">

    
    <link rel="stylesheet" href="{{ asset('assets/user/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css')}}">
  </head>

  <body>
    @include('layout.user.navbar')

    @yield('content')

    @include('layout.user.footer')

   <!-- loader -->
   <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


   <script src="{{ asset('assets/user/js/jquery.min.js')}}"></script>
   <script src="{{ asset('assets/user/js/jquery-migrate-3.0.1.min.js')}}"></script>
   <script src="{{ asset('assets/user/js/popper.min.js')}}"></script>
   <script src="{{ asset('assets/user/js/bootstrap.min.js')}}"></script>
   <script src="{{ asset('assets/user/js/jquery.easing.1.3.js')}}"></script>
   <script src="{{ asset('assets/user/js/jquery.waypoints.min.js')}}"></script>
   <script src="{{ asset('assets/user/js/jquery.stellar.min.js')}}"></script>
   <script src="{{ asset('assets/user/js/owl.carousel.min.js')}}"></script>
   <script src="{{ asset('assets/user/js/jquery.magnific-popup.min.js')}}"></script>
   <script src="{{ asset('assets/user/js/aos.js')}}"></script>
   <script src="{{ asset('assets/user/js/jquery.animateNumber.min.js')}}"></script>
   <script src="{{ asset('assets/user/js/bootstrap-datepicker.js')}}"></script>
   <script src="{{ asset('assets/user/js/jquery.timepicker.min.js')}}"></script>
   <script src="{{ asset('assets/user/js/scrollax.min.js')}}"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
   <script src="{{ asset('assets/user/js/google-map.js')}}"></script>
   <script src="{{ asset('assets/user/js/main.js')}}"></script>
     
   </body>
 </html>