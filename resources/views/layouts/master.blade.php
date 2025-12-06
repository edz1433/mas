<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MAS {{ isset($title) ? ' | ' . $title : '' }}</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free-v6/css/all.min.css') }}">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('template/plugins/toastr/toastr.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <!-- Logo -->
    <link rel="shortcut icon" href="{{ asset('Uploads/logo.png') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/style.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
<div class="wrapper">

    <!-- TOP NAVBAR -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-dark sidebar-dark-primary" >

        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <!-- Button to toggle sidebar -->
                <a class="nav-link" data-widget="pushmenu" href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <!-- Right navbar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <img src="{{ auth()->user()->profile_photo ?? asset('Uploads/user-default.png') }}" 
                        alt="User Avatar" class="img-circle elevation-2" style="width:35px; height:35px; margin-top: -10px; object-fit:cover;">
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">
                        {{ auth()->user()->fname }} {{ auth()->user()->lname }}<br>
                        <small>{{ auth()->user()->role ?? 'User' }}</small>
                    </span>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" 
                    class="dropdown-item"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <!-- LEFT SIDEBAR -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="{{ asset('Uploads/logo.png') }}" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-dark text-dark">Malabong Archive System</span>
        </a>

        <!-- Sidebar -->
        @include('partials.control')
    </aside>

    <!-- CONTENT WRAPPER -->
    <div class="content-wrapper">
        <div class="content">
            @yield('body')
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="main-footer">
        <strong>Maintain and Manage by <a href="#">MIS</a>.</strong> All rights reserved.
    </footer>

</div>

@include('script.driveScript')
@include('script.masterScript')
@include('script.empScript')
@include('script.userScript')
@include('script.officeScript')

</body>
</html>
