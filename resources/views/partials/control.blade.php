@extends('layouts.master')

@section('title', 'Dashboard')

@section('body')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <small class="text-muted">Welcome back, {{ auth()->user()->name ?? 'User' }}!</small>
    </div>

    <!-- Info Boxes Row -->
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDocuments ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalForm137 ?? 0 }}</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMemorandum ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-signature fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </-link></div>
        </div>

        <!-- Other Documents -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Other Documents
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOtherDocs ?? 0 }}</div>
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
        <!-- Document Distribution Pie Chart -->
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

        <!-- Monthly Uploads Bar Chart -->
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
                    <a href="{{ route('drive') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Document Name</th>
                                    <th>Category</th>
                                    <th>Uploaded By</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentUploads as $doc)
                                    <tr>
                                        <td>
                                            <a href="{{ route('drive.show', $doc->id) }}">{{ Str::limit($doc->name, 40) }}</a>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $doc->category == 'Form 137' ? 'info' : ($doc->category == 'Memorandum' ? 'success' : 'warning') }}">
                                                {{ $doc->category }}
                                            </span>
                                        </td>
                                        <td>{{ $doc->uploader?->name ?? 'Unknown' }}</td>
                                        <td>{{ $doc->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            No recent uploads yet. <a href="{{ route('drive') }}">Start uploading!</a>
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

    <!-- Premium Feature Teaser (Optional) -->
    @if(!auth()->user()->hasActiveSubscription())
    <div class="row">
        <div class="col-12">
            <div class="card border-left-danger shadow">
                <div class="card-body text-center">
                    <h5>Unlock Full School Management Features</h5>
                    <p class="mb-3">
                        Manage students, generate Form 137 automatically, track grades, promotions, and more — all in one place.
                    </p>
                    <button onclick="checkSubscription(event)" class="btn btn-danger btn-lg">
                        <i class="fas fa-crown"></i> Upgrade to School Plan
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection

@section('scripts')
<!-- Chart.js -->
<script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Pie Chart - Document Distribution
    const pieCtx = document.getElementById('documentsPieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Form 137', 'Memorandum', 'Other Documents'],
            datasets: [{
                data: [{{ $totalForm137 ?? 0 }}, {{ $totalMemorandum ?? 0 }}, {{ $totalOtherDocs ?? 0 }}],
                backgroundColor: ['#17a2b8', '#28a745', '#ffc107'],
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Bar Chart - Monthly Uploads
    const barCtx = document.getElementById('monthlyBarChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyLabels ?? []) !!},
            datasets: [{
                label: 'Number of Uploads',
                data: {!! json_encode($monthlyData ?? []) !!},
                backgroundColor: '#4e73df',
                borderColor: '#4e73df',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
});
</script>

<!-- Reuse the same checkSubscription function from your sidebar -->
<script>
function checkSubscription(e) {
    e.preventDefault();
    Swal.fire({
        icon: 'info',
        title: 'Premium Feature Locked',
        html: 'This feature is available in the <strong>School Plan</strong>.<br>Upgrade now to manage students, grades, Form 137, and more!',
        showCancelButton: true,
        confirmButtonText: 'Upgrade Now',
        cancelButtonText: 'Maybe Later',
        confirmButtonColor: '#e74a3b'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('billing.upgrade') }}"; // Change to your actual upgrade route
        }
    });
}
</script>
@endsection