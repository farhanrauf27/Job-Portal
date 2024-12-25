@extends('layouts.companyNav') {{-- Assuming you're extending a layout for the company sidebar --}}

@section('content')

<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h2 class="mb-4 text-primary"><i class="fas fa-briefcase"></i> Your Jobs</h2>
    @if($jobs->isEmpty())
        <div class="alert alert-warning text-center">
            <i class="fas fa-exclamation-circle"></i> No jobs have been created yet.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>SR No.</th>
                        <th>Job Title</th>
                        <th>Job Description</th>
                        <th>Location</th>
                        <th>Vacancy</th>
                        <th>Posted Date</th>
                        <th>Application Deadline</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $job->job_title }}</td>
                            <td class="job-description">
                                {{ Str::limit($job->job_description, 100) }}
                            </td>
                            <td>{{ $job->location }}</td>
                            <td class="text-center">{{ $job->vacancy }}</td>
                            <td>{{ \Carbon\Carbon::parse($job->posted_date)->format('d M, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($job->application_date)->format('d M, Y') }}</td>
                            <td class="actions">
                                <a href="{{ route('company.editJob', $job->id) }}" class="special-button-blue">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('company.deleteJob', $job->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="special-button-red" onclick="return confirm('Are you sure you want to delete this job?')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
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

.special-button {
    background-color: #ff4d4d; /* Bright red color for visibility */
    color: #fff; /* White text */
    border: none; /* Remove default border */
    border-radius: 5px; /* Rounded corners */
    padding: 8px 12px; /* Padding for a comfortable click area */
    font-size: 14px; /* Text size */
    font-weight: bold; /* Bold text for emphasis */
    transition: all 0.3s ease; /* Smooth transition for hover effects */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    display: inline-flex; /* Align icon and text properly */
    align-items: center; /* Vertical alignment */
    gap: 6px; /* Space between icon and text */
    cursor: pointer; /* Pointer cursor for clarity */
}

.special-button:hover {
    background-color: #e60000; /* Darker red for hover effect */
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15); /* Enhance shadow on hover */
    transform: translateY(-2px); /* Subtle lift effect */
}

.special-button:active {
    background-color: #cc0000; /* Even darker red for active state */
    transform: translateY(0); /* Reset lift effect */
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2); /* Reduce shadow on click */
}
.actions {
           
            align-items: center;
            /* gap: 10px; */
        }

        .actions a,
        .actions button {
            white-space: nowrap; /* Prevent wrapping of text */
        }

        /* Limit the width of the job description column */
        .job-description {
            max-width: 180px;  /* Set a maximum width for the job description */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap; /* Ensures the description stays in one line */
        }
</style>