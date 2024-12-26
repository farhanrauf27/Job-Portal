@extends('layouts.header')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0 text-white">My Applications</h2>
        </div>
        <div class="card-body p-4">
            @if ($applications->isEmpty())
                <div class="alert alert-info text-center">
                    You have not applied for any jobs yet.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>#</th>
                                <th>Job Title</th>
                                <th>Date Applied</th>
                                <th>Status</th>
                                <th>View CV</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $application)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $application->job->job_title ?? 'Job Deleted' }}</td>
                                    <td>{{ $application->created_at->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge 
    {{ $application->status == 'submitted' ? 'bg-warning' : '' }}
    {{ $application->status == 'in_review' ? 'bg-info' : '' }}
    {{ $application->status == 'accepted' ? 'bg-success' : '' }}
    {{ $application->status == 'rejected' ? 'bg-danger' : '' }} 
    status-badge">
    {{ ucfirst($application->status) }}
</span>

                                    </td>
                                    
                                    <td>
                                        <a href="{{ asset('storage/' . $application->cv_path) }}" 
                                           class="special-button-blue" 
                                           target="_blank">
                                           View CV
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    body {
    background-color: #f8f9fa;
}

.card {
    border-radius: 15px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.badge.bg-success {
    background-color: #28a745; /* Green */
    box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
}

.badge.bg-warning {
    background-color: #ffc107; /* Yellow */
    box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
}

.badge.bg-info {
    background-color: #17a2b8; /* Teal */
    box-shadow: 0 4px 8px rgba(23, 162, 184, 0.3);
}

.badge.bg-danger {
    background-color: #dc3545; /* Red */
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
}

.table th,
.table td {
    vertical-align: middle;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f2f2f2;
}

.status-badge {
    padding: 8px 16px;
    font-size: 14px;
    
    text-transform: capitalize;
    font-weight: bold;
    color: white;
    display: inline-block;
    cursor: pointer;
    text-align: center;
    border: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
}

.badge:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

</style>

@endsection
