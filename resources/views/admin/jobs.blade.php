@extends('layouts.adminNav')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Job Listings</h1>
        @if(session('success'))
        <div class="alert alert-danger">
            {{ session('success') }}
        </div>
        @endif
        <!-- Job Table Section -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Posted On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $job->job_title }}</td>
                            <td>{{ $job->company->company_name }}</td>
                            <td>{{ $job->location }}</td>
                            <td>{{ $job->created_at->format('d-m-Y') }}</td>
                            <td>
                                <!-- View Button (Eye) -->
                                <a href="{{ route('admin.viewJob', $job->id) }}" class="special-button-blue" title="View Job Details">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            
                                <!-- Delete Button -->
                                <form action="{{ route('admin.deleteJob', $job->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="special-button-red" onclick="return confirm('Are you sure you want to delete this job?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Optional: Add a button to add a new job -->
       
    </div>

    <!-- Styling for the table and buttons -->
    <style>
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-sm {
            padding: 0.2rem 0.4rem;
            font-size: 0.875rem;
        }

        .btn-danger {
            background-color: #e74a3b;
            border-color: #e74a3b;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        .btn-primary {
            background-color: #5bc0de;
            border-color: #5bc0de;
        }

        .btn-primary:hover {
            background-color: #31b0d5;
            border-color: #31b0d5;
        }

        .container {
            max-width: 1200px;
        }
    </style>
@endsection
