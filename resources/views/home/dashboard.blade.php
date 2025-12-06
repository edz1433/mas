@extends('layouts.master')

@section('body')
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Info Boxes -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalDocuments ?? 0 }}</h3>
                    <p>Total Documents</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalForm137 ?? 0 }}</h3>
                    <p>Form 137</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalMemorandum ?? 0 }}</h3>
                    <p>Memorandum</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-signature"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalOtherDocs ?? 0 }}</h3>
                    <p>Other Documents</p>
                </div>
                <div class="icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Documents Distribution</h3>
                </div>
                <div class="card-body">
                    <canvas id="documentsPieChart" style="min-height: 250px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Monthly Uploads</h3>
                </div>
                <div class="card-body">
                    <canvas id="monthlyBarChart" style="min-height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Uploads</h3>
                </div>
                <div class="card-body table-responsive p-0" style="max-height: 300px;">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Category</th>
                                <th>Uploaded By</th>
                                <th>Date Uploaded</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($recentUploads as $doc)
                            <tr>
                                <td>{{ $doc->name }}</td>
                                <td>{{ $doc->category }}</td>
                                <td>{{ $doc->uploaded_by }}</td>
                                <td>{{ $doc->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- ChartJS -->
<script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // PIE CHART - Document Distribution
    var pieCtx = document.getElementById('documentsPieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Form 137', 'Memorandum', 'Other Documents'],
            datasets: [{
                data: [{{ $totalForm137 ?? 1 }}, {{ $totalMemorandum ?? 2 }}, {{ $totalOtherDocs ?? 3 }}],
                backgroundColor: ['#17a2b8', '#28a745', '#ffc107']
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom'
            }
        }
    });

    // BAR CHART - Monthly Uploads
    var barCtx = document.getElementById('monthlyBarChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyLabels ?? []) !!},
            datasets: [{
                label: 'Uploads',
                data: {!! json_encode($monthlyData ?? []) !!},
                backgroundColor: '#2C3E50'
            }]
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
});
</script>

@endsection
