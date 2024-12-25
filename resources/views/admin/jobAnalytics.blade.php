@extends('layouts.adminNav')

@section('content')
<div class="container">
    {{-- <h1 class="text-center mb-2 text-primary">Job Analytics</h1> --}}

    <!-- Total Jobs -->
    <div class="card mb-4 shadow-lg rounded border-0">
        <div class="card-body text-center bg-light">
            <h4 class="card-title text-secondary">Total Jobs</h4>
            <p class="display-4 fw-bold text-primary">{{ $totalJobs }}</p>
        </div>
    </div>

    <!-- Job Analytics (Two Rows Layout) -->
    <div class="row">
        <!-- Jobs by Category -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-lg rounded border-0">
                <div class="card-body bg-light">
                    <h4 class="card-title text-center text-secondary">Jobs by Category</h4>
                    <canvas id="category-chart" class="chart-small"></canvas>
                </div>
            </div>
        </div>

        <!-- Jobs by Nature -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-lg rounded border-0">
                <div class="card-body bg-light">
                    <h4 class="card-title text-center text-secondary">Jobs by Nature</h4>
                    <canvas id="nature-chart" class="chart-small"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Jobs Posted Over Time -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-lg rounded border-0">
                <div class="card-body bg-light">
                    <h4 class="card-title text-center text-secondary">Jobs Posted Over Time (This Year)</h4>
                    <canvas id="yearly-jobs-chart" class="job-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for Category Chart
    var categoryLabels = @json($categoryLabels);
    var categoryCounts = @json($categoryCounts);

    // Data for Nature Chart
    var natureLabels = @json($natureLabels);
    var natureCounts = @json($natureCounts);

    // Data for Monthly Chart
    var yearlyMonthData = @json($monthsData);
    var yearlyMonths = yearlyMonthData.map(item => new Date(0, item.month - 1).toLocaleString('default', { month: 'short' }));
    var yearlyCounts = yearlyMonthData.map(item => item.total);

    // Category Chart
    var categoryCtx = document.getElementById('category-chart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Jobs by Category',
                data: categoryCounts,
                backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#2ecc71'],
                borderColor: ['#fff'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Nature Chart
    var natureCtx = document.getElementById('nature-chart').getContext('2d');
    new Chart(natureCtx, {
        type: 'pie',
        data: {
            labels: natureLabels,
            datasets: [{
                label: 'Jobs by Nature',
                data: natureCounts,
                backgroundColor: ['#e74c3c', '#3498db', '#9b59b6', '#f1c40f', '#1abc9c'],
                borderColor: ['#fff'],
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Yearly Jobs Chart
    var yearlyCtx = document.getElementById('yearly-jobs-chart').getContext('2d');
    new Chart(yearlyCtx, {
        type: 'bar',
        data: {
            labels: yearlyMonths,
            datasets: [{
                label: 'Jobs Posted (Current Year)',
                data: yearlyCounts,
                backgroundColor: '#1abc9c',
                borderColor: '#16a085',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#333',
                        stepSize: 1,
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    ticks: {
                        color: '#333',
                        font: {
                            size: 12
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1abc9c',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    cornerRadius: 5
                }
            }
        }
    });
</script>
@endsection
<style>
    .chart-small {
        width: 100% !important;
        max-width: 400px;
        height: auto !important;
        max-height: 300px;
        margin: 0 auto;
    }
    .job-chart{
        width: 100% !important;
        /* max-width: 400px; */
        height: auto !important;
        max-height: 300px;
        margin: 0 auto;

    }

    .card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-weight: bold;
    }
</style>