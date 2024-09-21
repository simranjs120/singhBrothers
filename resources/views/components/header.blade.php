<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Singh Brother Frames</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{Helper::props('assets/img/favicon.png')}}" rel="icon">
  <link href="{{Helper::props('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{Helper::props('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{Helper::props('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{Helper::props('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{Helper::props('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{Helper::props('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{Helper::props('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{Helper::props('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{Helper::props('assets/css/style.css')}}" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <!-- <h1 class="logo me-auto me-lg-0"><a href="index.html">Gp<span>.</span></a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="{{url('/')}}" class="logo me-auto me-lg-0"><img src="{{Helper::props('assets/img/logo.png')}}" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          @if($web->nav_tab_1!="")<li><a class="nav-link scrollto" href="{{$web->nav_tab_1_link}}">{{$web->nav_tab_1}}</a></li>@endif
          @if($web->nav_tab_2!="")<li><a class="nav-link scrollto" href="{{$web->nav_tab_2_link}}">{{$web->nav_tab_2}}</a></li>@endif
          @if($web->nav_tab_3!="")<li><a class="nav-link scrollto" href="{{$web->nav_tab_3_link}}">{{$web->nav_tab_3}}</a></li>@endif
          @if($web->nav_tab_4!="")<li><a class="nav-link scrollto " href="{{$web->nav_tab_4_link}}">{{$web->nav_tab_4}}</a></li>@endif
          @if($web->nav_tab_5!="")<li><a class="nav-link scrollto" href="{{$web->nav_tab_5_link}}">{{$web->nav_tab_5}}</a></li>@endif
          @if($web->nav_tab_6!="")<li><a class="nav-link scrollto" href="{{$web->nav_tab_6_link}}">{{$web->nav_tab_6}}</a></li>@endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <!-- <a href="#about" class="get-started-btn scrollto">Contact Us</a> -->

    </div>
  </header><!-- End Header -->