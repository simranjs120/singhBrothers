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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js" defer></script> -->
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css"/> -->

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css" />

    <link rel="stylesheet" href="{{Helper::props('admin/vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{Helper::props('admin/vendors/css/vendor.bundle.base.css')}}">

    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
    <link rel="stylesheet" href="js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{Helper::props('admin/css/vertical-layout-light/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{Helper::props('assets/img/favicon.png')}}" />
</head>
<style>
    .asterik {
        color: red;
    }

    .breadcrumbs {
        color: black;
    }

    .breadcrumbs-active {
        color: blue;
    }

    .breadcrumbs:hover {
        cursor: pointer;
    }

    .breadcrumbs-active:hover {
        cursor: pointer;
    }

    .pull-right {
        float: right;
    }

    a {
        text-decoration: none;
        color: black;
    }

    @media(max-width:992px) {
        .dashboard-stats-glance {
            margin-top: 30px;
        }

        #mobile-agent {
            display: block !important;
        }

        #pc-agent {
            display: none !important;
        }
    }

    #mobile-agent {
        display: none;
    }

    #pc-agent {
        display: block;
    }

    .badge-success {
        background-color: green;
        color: white;
        border: 1px solid green;
    }

    .badge-danger {
        background-color: red;
        color: white;
        border: 1px solid red;
    }
</style>

<body>
    <div class="container-scroller">
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <!--***************************************************************************************************************************************************
             FOR BRAND NAME ON LEFT, BRAND NAME WILL ALSO COLLAPSE WITH MENU,UNCOMMENT THIS & REMOVE THE CONTENT FROM INSIDE OF BELOW DIV "navbar-menu-wrapper" CLASS
            **************************************************************************************************************************************************** -->
            <!-- <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="brand-logo text-decoration-none d-none d-lg-block" href="{{url('admin/dashboard')}}">
                        <h3 class="text-dark mt-1"><b><span class="text-primary">SB</span> Admin</b></h3>
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="{{url('admin/dashboard')}}">
                        <img src="{{Helper::props('admin/images/logo-mini.svg')}}" alt="logo" />
                    </a>
                </div>
            </div> -->
            <!--***************************************************************************************************************************************************
             FOR BRAND NAME ON LEFT, BRAND NAME WILL ALSO COLLAPSE WITH MENU,UNCOMMENT THIS & REMOVE THE CONTENT FROM INSIDE OF BELOW DIV "navbar-menu-wrapper" CLASS
            **************************************************************************************************************************************************** -->

            <div class="navbar-menu-wrapper d-flex align-items-top">
                <!--***************************************************************************************************************************************************
             FOR BRAND NAME TO BE ON LEFT AND COLLAPSABLE,REMOVE THIS DIV FROM HERE, UNCOMMENT THE ABOVE CODE WITH THAT HAS "navbar-brand-wrapper" CLASS.
            **************************************************************************************************************************************************** -->
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                            data-bs-toggle="minimize">
                            <span class="icon-menu"></span>
                        </button>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold">
                        <a class="brand-logo text-decoration-none" href="{{url('admin/dashboard')}}">
                            <img src="{{Helper::props('admin/images/logo.png')}}" class="img-fluid" width="auto" height="auto"/>
                        </a>
                    </li>
                </ul>
            <!--***************************************************************************************************************************************************
             FOR BRAND NAME TO BE ON LEFT AND COLLAPSABLE,REMOVE THIS DIV FROM HERE, UNCOMMENT THE ABOVE CODE WITH THAT HAS "navbar-brand-wrapper" CLASS.
            **************************************************************************************************************************************************** -->

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-lg-block d-none d-md-block">
                        <button type="button" class="btn btn-light nav-custom-button"><b>Store</b> <i class="mdi mdi-octagon signal-active"></i></button>    
                    </li>
                    <li class="nav-item dropdown d-lg-block d-none d-md-block">
                        <button type="button" class="btn btn-light nav-custom-button"><i class="mdi mdi-magnify"></i>&nbsp;Search</button>
                    </li>
                    <li class="nav-item dropdown d-lg-block d-none d-md-block">
                        <a class="" href="{{str_replace('/public', "/", Helper::props('/'))}}" target="_blank">
                            <button type="button" class="btn btn-light nav-custom-button"><i class="mdi mdi-web"></i>&nbsp;Visit Store</button>
                        </a>
                    </li>
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
                                <!-- <div class="preview-thumbnail">
                                    <img src="{{Helper::props('admin/images/faces/face10.jpg')}}" alt="image" class="img-sm profile-pic">
                                </div> -->
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <!-- <div class="preview-thumbnail">
                                    <img src="{{Helper::props('admin/images/faces/face12.jpg')}}" alt="image" class="img-sm profile-pic">
                                </div> -->
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <!-- <div class="preview-thumbnail">
                                    <img src="{{Helper::props('images/faces/face1.jpg')}}" alt="image" class="img-sm profile-pic">
                                </div> -->
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <?php
                        $letter = ucfirst(substr($profile->name, 0, 1)); 
                    ?>
                    <li class="nav-item dropdown  d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle"
                                src="{{Helper::props('admin/images/dp/' . $letter . '.png')}}" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle"
                                    src="{{Helper::props('admin/images/dp/' . $letter . '.png')}}" alt="Profile image">
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
                            <button type="submit" class="border-0 bg-transparent w-100">
                                <a class="dropdown-item" href="{{url('/admin/add-user')}}"><i
                                        class="dropdown-item-icon mdi mdi-account-question text-primary me-2"></i>
                                    Roles and Permissions</a>
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
            <x-admin-sidebar />

            <div class="main-panel mt-0">
                <div class="content-wrapper">