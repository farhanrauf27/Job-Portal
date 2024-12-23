@extends('layouts.adminNav')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4 text-primary">Job Details</h1>

        <div class="card shadow-lg rounded border-light">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ $job->job_title }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Company:</strong> {{ $job->company->company_name }}</p>
                        <p><strong>Location:</strong> {{ $job->location }}</p>
                        <p><strong>Description:</strong> {{ $job->job_description }}</p>
                        <p><strong>Requirements:</strong> {{ $job->required_skills }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Experience:</strong> {{ $job->education_experience }}</p>
                        <p><strong>Total No. of Posts:</strong> {{ $job->vacancy }}</p>
                        <p><strong>Posted On:</strong> {{ $job->created_at->format('d-m-Y') }}</p>
                        <p><strong>Job Type:</strong> {{ $job->job_nature }}</p>
                        <p><strong>Salary:</strong> {{ $job->salary }}</p>
                    </div>
                </div>
                
                <hr class="my-4">

                <div class="text-center">
                    <p><strong>Application Deadline:</strong> {{ \Carbon\Carbon::parse($job->application_date)->format('d-m-Y') }}</p>
                    <a href="{{ route('admin.jobs') }}" class="btn btn-outline-primary btn-lg mt-3">
                        <i class="fas fa-arrow-left"></i> Back to Job Listings
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Add some custom styles -->
    <style>
        .card-header {
            background-color: #007bff;
        }
        .card-body {
            font-size: 1.1rem;
            line-height: 1.6;
        }
        .btn-outline-primary {
            border: 2px solid #007bff;
            color: #007bff;
            transition: all 0.3s ease;
        }
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }
        hr.my-4 {
            border-color: #007bff;
            height: 2px;
        }
    </style>
@endsection
