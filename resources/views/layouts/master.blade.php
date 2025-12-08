@extends('layouts.master')

@section('title', 'Dashboard')

@section('body')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <small class="text-muted">Welcome back, {{ auth()->user()->name ?? 'User' }}!</small>
    </div>

<<<<<<< HEAD
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
                    <img src="{{ asset('Uploads/profile/'.auth()->user()->profile) }}" 
                        alt="User Avatar" class="img-circle elevation-2" style="width:35px; height:35px; margin-top: -10px; object-fit:cover;">
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">
                        {{ auth()->user()->fname }} {{ auth()->user()->lname }}<br>
                        <small>{{ auth()->user()->role }}</small>
                    </span>
                <!-- Account Settings -->
                <a href="{{ route('account.index') }}" class="dropdown-item">
                    <i class="fas fa-user-cog mr-2 text-info"></i> Account Settings
                </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" 
                    class="dropdown-item"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt text-danger mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
=======
    <!-- Info Boxes -->
    <div class="row">
        <!-- Total Documents -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Documents
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalDocuments ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
>>>>>>> 777a96406e44bbe39a6a431482101893bcfb77c3
                </div>
            </div>
        </div>

        <!-- Form 137 -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Form 137 (SF10)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalForm137 ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Memorandum -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Memorandum
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalMemorandum ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-signature fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<<<<<<< HEAD
        <!-- Sidebar -->
        @include('partials.control')
    </aside>

    <!-- CONTENT WRAPPER -->
    <div class="content-wrapper mt-1">
        <div class="content">
            @yield('body')
        </div>
    </div>

    <!-- FOOTER -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right (optional version) -->
        <div class="float-right d-none d-sm-inline">
            <small>Version 1.0</small>
        </div>

        <!-- Default Content (Centered) -->
        <div class="text-left">
            Developed by <strong>Edwin Abril Jr.</strong>
            &nbsp;•&nbsp;
            <a href="https://www.facebook.com/eabril.27" target="_blank" class="text-decoration-none">
                <i class="fab fa-facebook-f"></i> Facebook
            </a>
            &nbsp;•&nbsp;
            Powered by
            <a href="https://www.facebook.com/kerritsolution" target="_blank" class="text-decoration-none">
                <strong>Kerr IT Solutions</strong>
            </a>
        </div>
    </footer>
=======
        <!-- Other Documents -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Other Documents
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalOtherDocs ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Document Distribution -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Document Distribution</h6>
                </div>
                <div class="card-body">
                    <canvas id="documentsPieChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Monthly Uploads -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Monthly Uploads ({{ date('Y') }})</h6>
                </div>
                <div class="card-body">
                    <canvas id="monthlyBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Uploads Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Uploads</h6>
                    <a href="{{ route('drive') }}" class="btn btn-sm btn-primary shadow">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Document Name</th>
                                    <th>Category</th>
                                    <th>Uploaded By</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentUploads ?? [] as $doc)
                                    <tr>
                                        <td>
                                            <a href="{{ route('drive.show', $doc->id ?? '#') }}">
                                                {{ \Illuminate\Support\Str::limit($doc->name ?? 'Untitled', 40) }}
                                            </a>
                                        </td>
                                        <td>
                                            @php
                                                $badge = match($doc->category ?? '') {
                                                    'Form 137' => 'info',
                                                    'Memorandum' => 'success',
                                                    default => 'secondary'
                                                };
                                            @endphp
                                            <span class="badge badge-{{ $badge }}">
                                                {{ $doc->category ?? 'Uncategorized' }}
                                            </span>
                                        </td>
                                        <td>{{ $doc->uploader?->name ?? 'System' }}</td>
                                        <td>{{ optional($doc->created_at)->format('M d, Y') ?? '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-5">
                                            <i class="fas fa-inbox fa-3x mb-3 text-gray-300"></i><br>
                                            No uploads yet. <a href="{{ route('drive') }}">Start uploading documents</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium Teaser -->
    @if(! (auth()->user()->hasActiveSubscription ?? false) )
    <div class="row">
        <div class="col-12">
            <div class="card border-left-danger shadow">
                <div class="card-body text-center py-5">
                    <h4>Unlock Full School Management</h4>
                    <p class="lead mb-4">
                        Manage students, generate Form 137 automatically, input grades, track promotions & more!
                    </p>
                    <button onclick="checkSubscription(event)" class="btn btn-danger btn-lg px-5">
                        <i class="fas fa-crown mr-2"></i> Upgrade to School Plan
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
>>>>>>> 777a96406e44bbe39a6a431482101893bcfb77c3

</div>
@endsection
@include('script.driveScript')
@include('script.masterScript')
@yield('scripts')
@include('script.empScript')
@include('script.officeScript')
@section('scripts')
<script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Document Distribution (Doughnut Chart)
    new Chart(document.getElementById('documentsPieChart'), {
        type: 'doughnut',
        data: {
            labels: ['Form 137', 'Memorandum', 'Other Documents'],
            datasets: [{
                data: [
                    {{ $totalForm137 ?? 0 }},
                    {{ $totalMemorandum ?? 0 }},
                    {{ $totalOtherDocs ?? 0 }}
                ],
                backgroundColor: ['#17a2b8', '#28a745', '#ffc107'],
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Monthly Uploads Bar Chart
    new Chart(document.getElementById('monthlyBarChart'), {
        type: 'bar',
        data: {
            labels: @json($monthlyLabels ?? []),
            datasets: [{
                label: 'Uploads',
                data: @json($monthlyData ?? []),
                backgroundColor: '#4e73df',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
});
</script>

<!-- Reuse your existing checkSubscription function -->
<script>
function checkSubscription(e) {
    e.preventDefault();
    Swal.fire({
        icon: 'info',
        title: 'Premium Feature Locked',
        html: 'This feature is part of the <strong>School Plan</strong>.<br>Upgrade now to unlock student management, grades, Form 137 generator, and more!',
        showCancelButton: true,
        confirmButtonText: 'Upgrade Now',
        cancelButtonText: 'Maybe Later',
        confirmButtonColor: '#e74a3b'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('billing.upgrade', [], false) }}"; // fallback if route doesn't exist
        }
    });
}
</script>
@endsection