@extends('layouts.master')

@section('body')
<div class="container-fluid mt-4">
<!-- Total Documents, Teachers, Students Boxes -->
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalDocuments }}</h3>
                    <p>Total Documents</p>
                </div>
                <div class="icon"><i class="fas fa-file-alt"></i></div>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalTeachers }}</h3>
                    <p>Total Teachers & Principals</p>
                </div>
                <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalStudents }}</h3>
                    <p>Total Students</p>
                </div>
                <div class="icon"><i class="fas fa-user-graduate"></i></div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mt-3">
        <!-- PIE CHART - Folder Distribution -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Documents Distribution by Folder</h3>
                </div>
                <div class="card-body">
                    <canvas id="documentsPieChart" style="min-height: 250px;"></canvas>
                </div>
            </div>
        </div>

        <!-- BAR CHART - Monthly Uploads -->
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

    <!-- Charts Row -->
    {{-- <div class="row">
        <!-- PIE CHART -->
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

        <!-- BAR CHART -->
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
    </div> --}}

    <!-- Recent Uploads Table -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Uploads</h3>
                </div>
                <div class="card-body table-responsive p-0" style="max-height: 300px;">
                     <table class="table table" id="table-logs">
                        <thead>
                            <tr>
                                <th>logs</th>
                                <th>Date Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentUploads as $log)
                                @if($log->action == 1)
                                <tr>
                                    <td>
                                        <span class="user"><b>{{ ucwords(strtolower($log->fname)) }} {{ ucwords(strtolower($log->lname)) }}</b></span> 
                                        <span class="text-success"><b>uploaded</b></span> a file 
                                        <span class="text-info"><a href="{{ isset($log->folder_id) ? route('sub-folder', ['id' => $log->folder_id]) : '' }}" style="text-decoration: none; color: inherit;"><b>{{ $log->prev_file }}</b></a></span>
                                    </td>
                                    <td class="timestamp">{{ $log->created_at->format('F j, Y, g:i A') }}</td>
                                </tr>
                                @endif
                                @if($log->action == 2)
                                <tr>
                                    <td>
                                        <span class="user"><b>{{ ucwords(strtolower($log->fname)) }} {{ ucwords(strtolower($log->lname)) }}</b></span> 
                                        <span class="text-warning"><b>renamed</b></span>  the file 
                                        <span class="text-info"><b>{{ $log->prev_file }}</b></span> to 
                                        <span class="text-info"><a href="{{ isset($log->folder_id) ? route('sub-folder', ['id' => $log->folder_id]) : '' }}" style="text-decoration: none; color: inherit;"><b>{{ $log->new_file }}</b></a> </span>
                                    </td>
                                    <td class="timestamp">{{ $log->created_at->format('F j, Y, g:i A') }}</td>
                                </tr>
                                @endif

                                @if($log->action == 3)
                                <tr>
                                    <td>
                                        <span class="user"><b>{{ ucwords(strtolower($log->fname)) }} {{ ucwords(strtolower($log->lname)) }}</b></span> 
                                        <span class="text-danger"><b>deleted</b></span>  the file 
                                        <span class="text-info"><b>{{ $log->prev_file }}</b></span>
                                    </td>
                                    <td class="timestamp">{{ $log->created_at->format('F j, Y, g:i A') }}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // PIE CHART
    var pieCtx = document.getElementById('documentsPieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($documentsByFolder->keys()) !!},
            datasets: [{
                data: {!! json_encode($documentsByFolder->values()) !!},
                backgroundColor: ['#17a2b8','#28a745','#ffc107','#dc3545','#6f42c1','#fd7e14']
            }]
        },
        options: { responsive: true, legend: { position: 'bottom' } }
    });

    // BAR CHART - Monthly Uploads
    var barCtx = document.getElementById('monthlyBarChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyLabels) !!},
            datasets: [{
                label: 'Uploads',
                data: {!! json_encode($monthlyData) !!},
                backgroundColor: '#2C3E50'
            }]
        },
        options: {
            responsive: true,
            scales: { yAxes: [{ ticks: { beginAtZero: true } }] }
        }
    });
});
</script>
@endsection
