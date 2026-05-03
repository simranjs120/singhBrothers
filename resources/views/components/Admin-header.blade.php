<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Singh Brothers - Admin Panel</title>

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{Helper::props('admin/css/sb-admin-redesign.css')}}">
    <link rel="shortcut icon" href="{{Helper::props('assets/img/favicon.png')}}" />
</head>



<body class="bg-light text-dark sb-admin-body">
    <div class="container-scroller sb-admin-shell">
        <div class="container-fluid page-body-wrapper p-0">
            <x-admin-sidebar />

            <div class="main-panel mt-0 sb-admin-main">
                <div class="content-wrapper bg-light min-vh-100 pt-4">
                    <button
                        class="btn btn-dark d-inline-flex align-items-center justify-content-center d-lg-none mb-3 px-3 py-2"
                        type="button" data-bs-toggle="offcanvas" aria-label="Open menu">
                        <i class="bi bi-list"></i>
                    </button>