@extends('layouts.adminNav')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-5 text-primary">Job Analytics</h1>

        <!-- Total Jobs -->
        <div class="card mb-4 shadow-lg rounded border-0">
            <div class="card-body text-center bg-light">
                <h4 class="card-title text-secondary">Total Jobs</h4>
                <p class="display-4 fw-bold text-primary">{{ $totalJobs }}</p>
            </div>
        </div>

        <!-- Job Analytics (Two Columns Layout) -->
        <div class="row">
            <!-- Left Column (Jobs by Category) -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg rounded border-0">
                    <div class="card-body bg-light">
                        <h4 class="card-title text-center text-secondary">Jobs by Category</h4>
                        <canvas id="category-chart" class="chart-small"></canvas>
                    </div>
                </div>
            </div>

            <!-- Right Column (Jobs Posted Over Time) -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg rounded border-0">
                    <div class="card-body bg-light">
                        <h4 class="card-title text-center text-secondary">Jobs Posted Over Time (Last 12 Months)</h4>
                        <canvas id="monthly-jobs-chart" class="chart-small"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Ensure category data is available and properly formatted
        var categoryLabels = @json($categoryLabels); // Labels
        var categoryCounts = @json($categoryCounts); // Counts

        // Job Analytics by Category (Pie Chart)
        var categoryCtx = document.getElementById('category-chart').getContext('2d');
        var categoryChart = new Chart(categoryCtx, {
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
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#2ecc71',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        cornerRadius: 5
                    }
                }
            }
        });

        // Jobs Posted Over Time (Bar Chart)
        var monthData = @json($jobsByMonth);
        var months = monthData.map(item => new Date(0, item.month - 1).toLocaleString('default', { month: 'short' }));
        var monthlyCounts = monthData.map(item => item.total);

        var monthlyCtx = document.getElementById('monthly-jobs-chart').getContext('2d');
        var monthlyChart = new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Jobs Posted Over Time',
                    data: monthlyCounts,
                    backgroundColor: '#3498db',
                    borderColor: '#2980b9',
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
                        backgroundColor: '#3498db',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        cornerRadius: 5
                    }
                }
            }
        });
    </script>

    <!-- Custom Styles -->
    <style>
        .chart-small {
            width: 100% !important;
            max-width: 400px;
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
@endsection
