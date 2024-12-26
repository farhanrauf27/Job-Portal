@extends('layouts.companyNav')

@section('content')
<div class="container mt-5">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ request('application_status', 'new') == 'past' ? 'Past Applications' : 'New Applications' }}</h2>
    
        <!-- Dropdown and Buttons for Application Filters -->
        <form action="{{ route('company.applications') }}" method="GET" class="d-flex align-items-center justify-content-between">

            <!-- Job Dropdown to filter applications -->
            <div class="input-group me-3" style="max-width: 350px;">
                <select name="job_id" class="form-select shadow-sm rounded-pill border-0" onchange="this.form.submit()">
                    <option value="" disabled selected>Select a Job</option>
                    @foreach ($jobs as $index => $job)
                        <option value="{{ $job->id }}" 
                            @if(request('job_id') == $job->id) selected @endif>
                            Job {{ $index + 1 }}: {{ $job->job_title }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <!-- Hidden input for application status -->
            <input type="hidden" name="application_status" value="{{ request('application_status', 'new') }}">
        
            <!-- Button for submitting the form (optional styling for clear CTA) -->
          
        </form>
        

        <!-- Button for Past Applications or New Applications -->
        <div class="ms-3">
            @if(request('application_status') == 'past')
                <a href="{{ route('company.applications', ['application_status' => 'new']) }}" class="special-button-blue">
                    <i class="fas fa-arrow-left me-2"></i> New Applications
                </a>
            @else
                <a href="{{ route('company.applications', ['application_status' => 'past']) }}" class="special-button-red">
                    <i class="fas fa-arrow-right me-2"></i> Past Applications
                </a>
            @endif
        </div>
        
    </div>
    

    @if ($applications->isEmpty())
        <div class="alert alert-info text-center">
            No applications have been submitted yet.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Applicant Name</th>
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
                            <td>{{ $application->user->name ?? 'Unknown' }}</td>
                            <td>{{ $application->job->job_title ?? 'Job Deleted' }}</td>
                            <td>{{ $application->created_at->format('d M Y') }}</td>
                            <td>
                                <!-- Form for status dropdown -->
                                <form action="{{ route('company.updateApplicationStatus', $application->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                            
                                    <select style="outline:none;" name="status" class="form-select 
                                        @if($application->status == 'accepted') bg-success @elseif($application->status == 'rejected') bg-danger @endif"
                                        @if(in_array($application->status, ['accepted', 'rejected'])) disabled @endif
                                        onchange="this.form.submit()">
                                        <option value="submitted" @if($application->status == 'submitted') selected @endif>Submitted</option>
                                        <option value="in_review" @if($application->status == 'in_review') selected @endif>In Review</option>
                                        <option value="accepted" @if($application->status == 'accepted') selected @endif>Accepted</option>
                                        <option value="rejected" @if($application->status == 'rejected') selected @endif>Rejected</option>
                                    </select>
                                </form>
                            </td>
                            
                            
                            
                            

                            <td>
                                <a href="{{ asset('storage/' . $application->cv_path) }}" class="special-button-green" target="_blank">View CV</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
<style>
    .bg-success {
    background-color: #28a745 !important; /* Green */
    color: white !important;
}

.bg-danger {
    background-color: #dc3545 !important; /* Red */
    color: white !important;
}
/* Styling for form elements */
.form-select {
    background-color: #f8f9fa;
    font-size: 1rem;
    color: #495057;
    outline: none;
}

.form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    font-size: 1rem;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

input[type="hidden"] {
    display: none;
}


</style>

