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
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{Helper::props('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <!-- <link href="{{Helper::props('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- <link href="{{Helper::props('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{Helper::props('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{Helper::props('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{Helper::props('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{Helper::props('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

  <!-- Main CSS File -->
  <link href="{{Helper::props('assets/css/style.css')}}" rel="stylesheet">

</head>

<body>

  <!-- Bootstrap Navbar -->
  <header id="header" class="fixed-top bg-white shadow-sm border-bottom border-dark">
    <div class="container">

      <nav class="navbar navbar-expand-lg navbar-light">

        <!-- Logo -->
        <a class="navbar-brand" href="{{url('/')}}">
          <img src="{{Helper::props('assets/img/logo.png')}}" alt="" class="logo-img">
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu + Button -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">

          <ul class="navbar-nav align-items-lg-center fw-bold">

            @if($web->nav_tab_1 != "")
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{$web->nav_tab_1_link}}">{{$web->nav_tab_1}}</a>
              </li>
            @endif

            @if($web->nav_tab_2 != "")
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{$web->nav_tab_2_link}}">{{$web->nav_tab_2}}</a>
              </li>
            @endif

            @if($web->nav_tab_3 != "")
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{$web->nav_tab_3_link}}">{{$web->nav_tab_3}}</a>
              </li>
            @endif

            @if($web->nav_tab_4 != "")
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{$web->nav_tab_4_link}}">{{$web->nav_tab_4}}</a>
              </li>
            @endif

            @if($web->nav_tab_5 != "")
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{$web->nav_tab_5_link}}">{{$web->nav_tab_5}}</a>
              </li>
            @endif

            @if($web->nav_tab_6 != "")
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{$web->nav_tab_6_link}}">{{$web->nav_tab_6}}</a>
              </li>
            @endif

            <!-- Contact Button -->
            <li class="nav-item ms-lg-3 mt-3 mt-lg-0 fw-normal mb-4 mb-lg-0">
              <a href="#about" class="px-4 py-2 bg-dark text-light border border-0 rounded-3">Contact Us</a>
            </li>

          </ul>

        </div>

      </nav>

    </div>
  </header>

  <!-- IMPORTANT FIX FOR OVERLAP -->
  <div style="height: 80px;"></div>