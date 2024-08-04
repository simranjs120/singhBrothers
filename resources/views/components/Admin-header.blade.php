<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Singh Brothers - Admin Panel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{Helper::props('admin/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{Helper::props('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{Helper::props('admin/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{Helper::props('admin/vendors/typicons/typicons.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js" defer></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css"/>


   
    <link rel="stylesheet" href="{{Helper::props('admin/vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{Helper::props('admin/vendors/css/vendor.bundle.base.css')}}">

    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{Helper::props('admin/css/vertical-layout-light/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{Helper::props('admin/images/favicon.png')}}" />
</head>
<style>
    .breadcrumbs{
        color:black;
    }
    .breadcrumbs-active{
        color:blue;
    }
    .breadcrumbs:hover{
        cursor:pointer;
    }
    .breadcrumbs-active:hover{
        cursor:pointer;
    }
    .pull-right{
        float: right;
    }
    a{
        text-decoration:none;
        color:black;
    }
</style>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="brand-logo text-decoration-none d-none d-lg-block" href="{{url('admin/dashboard')}}">
                        <!-- <marquee class="text-dark mt-2" scrollamount="5"> -->
                        <h3 class="text-dark mt-1"><b><span class="text-primary">SB</span> Admin</b></h3>
                        <!-- </marquee> -->
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="{{url('admin/dashboard')}}">
                        <img src="{{Helper::props('admin/images/logo-mini.svg')}}" alt="logo" />
                    </a>
                </div>
            </div>
            @php
                date_default_timezone_set("Asia/Calcutta");
                $time=date("H");
                $salutation="a";
                if($time>=4 && $time<12){
                    $salutation="Good Morning";
                } else if($time>=12 && $time<16){
                    $salutation="Good Afternoon";
                } else if($time>=16 && $time<20){
                    $salutation="Good Evening";   
                } else {
                    $salutation="Nighty Night";
                }
            @endphp
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text"><?php echo $salutation; ?>, <span class="text-black fw-bold">{{$profile->name}}</span></h1>
                        <h3 class="welcome-sub-text">Welcome Back To The Admin Panel</h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block">
                        <img src="{{Helper::props('admin/images/logo.png')}}" class="img-fluid" width="90%" height="auto" />
                    </li>

                    <li class="nav-item d-none d-lg-block">
                        <!-- Empty usable block -->
                    </li>

                    <!-- <li class="nav-item">
            <form class="search-form" action="#">
              <i class="icon-search"></i>
              <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form>
          </li> -->

                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="icon-bell"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                            aria-labelledby="countDropdown">
                            <a class="dropdown-item py-3">
                                <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                                <span class="badge badge-pill badge-primary float-right">View all</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{Helper::props('admin/images/faces/face10.jpg')}}" alt="image" class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{Helper::props('admin/images/faces/face12.jpg')}}" alt="image" class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{Helper::props('images/faces/face1.jpg')}}" alt="image" class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown  d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{Helper::props('admin/images/admin.png')}}" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="{{Helper::props('admin/images/admin.png')}}" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">{{$profile->name}}</p>
                                <p class="fw-light text-muted mb-0">{{$profile->email}}</p>
                            </div>
                            <button type="button" class="border-0 bg-transparent w-100">
                                <a class="dropdown-item" href="{{url('/admin/my-profile')}}"><i
                                        class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
                                    Profile</a>
                            </button>
                            <button type="submit" class="border-0 bg-transparent w-100">
                                <a class="dropdown-item" href="{{url('/admin/add-user')}}"><i
                                        class="dropdown-item-icon mdi mdi-account-multiple-plus text-primary me-2"></i>
                                    Add New User</a>
                            </button>
                            <form action="{{url('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="border-0 bg-transparent w-100">
                                    <a class="dropdown-item"><i
                                            class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
      <!-- Settings to change theme (temporary) -->
      <!-- <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border me-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border me-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div> -->
      
      <!-- Sidebar -->
      <x-admin-sidebar/>

      <div class="main-panel">
        <div class="content-wrapper">