<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Singh Brothers - Admin Panel</title>

    <link rel="stylesheet" href="{{Helper::props('admin/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{Helper::props('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{Helper::props('admin/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{Helper::props('admin/vendors/typicons/typicons.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

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
    <link rel="stylesheet" href="js/select.dataTables.min.css">
    <link rel="stylesheet" href="{{Helper::props('admin/css/vertical-layout-light/style.css')}}">
    <link rel="stylesheet" href="{{Helper::props('admin/css/sb-admin-redesign.css')}}">
    <link rel="shortcut icon" href="{{Helper::props('assets/img/favicon.png')}}" />
</head>

@php
    date_default_timezone_set(env('APPLICATION_TIMEZONE'));
    $hour = (int) date('H');
    if ($hour >= 4 && $hour < 12) {
        $salutation = 'Good Morning,';
    } elseif ($hour >= 12 && $hour < 17) {
        $salutation = 'Good Afternoon,';
    } elseif ($hour >= 17 && $hour < 21) {
        $salutation = 'Good Evening,';
    } else {
        $salutation = 'Good Night,';
    }
    $letter = ucfirst(substr($profile->name, 0, 1));
    $path = trim(request()->path(), '/') . '/';
@endphp

<body class="bg-light text-dark sb-admin-body">
    <div class="container-scroller sb-admin-shell">
        <div class="container-fluid page-body-wrapper p-0">
            <x-admin-sidebar />

            <div class="main-panel mt-0 sb-admin-main">
                <div class="content-wrapper bg-light min-vh-100 p-4 ps-lg-3 pe-lg-4 sb-admin-content">
                    <button class="btn btn-dark d-inline-flex align-items-center justify-content-center d-lg-none mb-3 px-3 py-2" type="button" data-bs-toggle="offcanvas" aria-label="Open menu">
                        <i class="mdi mdi-menu"></i>
                    </button>

                    <div class="mb-4">
                        <div class="d-flex align-items-start align-items-lg-center gap-3 mb-4">
                            <img class="rounded" src="{{Helper::props('admin/images/dp/' . $letter . '.png')}}" width="32" height="32" alt="{{$profile->name}}">
                            <h1 class="h2 fw-normal lh-sm mb-0">{{$salutation}} <strong class="fw-bold d-block d-lg-inline">{{$profile->name}}</strong></h1>
                        </div>
                        <div class="fs-6 text-dark">{{$path}}</div>
                    </div>
