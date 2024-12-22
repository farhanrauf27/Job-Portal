@extends('layouts.companyNav')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center text-primary">
        <i class="fas fa-edit"></i> Edit Job
    </h2>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Job Edit Form -->
    <form action="{{ route('company.updateJob', $job->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="card shadow-sm p-4 mb-5 border-0 rounded-4 bg-light">
            <!-- Job Title -->
            <div class="form-group mb-3">
                <label for="job_title" class="form-label text-dark fw-bold"><i class="fas fa-briefcase me-2"></i> Job Title</label>
                <input type="text" class="form-control rounded-pill" name="job_title" id="job_title" value="{{ old('job_title', $job->job_title) }}" required>
                @error('job_title')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Job Description -->
            <div class="form-group mb-3">
                <label for="job_description" class="form-label text-dark fw-bold"><i class="fas fa-file-alt me-2"></i> Job Description</label>
                <textarea class="form-control rounded-3" name="job_description" id="job_description" rows="4">{{ old('job_description', $job->job_description) }}</textarea>
                @error('job_description')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Required Skills -->
            <div class="form-group mb-3">
                <label for="required_skills" class="form-label text-dark fw-bold"><i class="fas fa-cogs me-2"></i> Required Skills</label>
                <textarea class="form-control rounded-3" name="required_skills" id="required_skills" rows="4">{{ old('required_skills', $job->required_skills) }}</textarea>
                @error('required_skills')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Education & Experience -->
            <div class="form-group mb-3">
                <label for="education_experience" class="form-label text-dark fw-bold"><i class="fas fa-graduation-cap me-2"></i> Education & Experience</label>
                <textarea class="form-control rounded-3" name="education_experience" id="education_experience" rows="4">{{ old('education_experience', $job->education_experience) }}</textarea>
                @error('education_experience')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Other Fields -->
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="posted_date" class="form-label text-dark fw-bold"><i class="fas fa-clock me-2"></i> Posted Date</label>
                    <input type="date" class="form-control rounded-pill" name="posted_date" id="posted_date" value="{{ old('posted_date', $job->posted_date) }}">
                    @error('posted_date')
                        <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="location" class="form-label text-dark fw-bold"><i class="fas fa-map-marker-alt me-2"></i> Location</label>
                    <input type="text" class="form-control rounded-pill" name="location" id="location" value="{{ old('location', $job->location) }}">
                    @error('location')
                        <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <label for="vacancy" class="form-label text-dark fw-bold"><i class="fas fa-users me-2"></i> Vacancy</label>
                    <input type="number" class="form-control rounded-pill" name="vacancy" id="vacancy" value="{{ old('vacancy', $job->vacancy) }}">
                    @error('vacancy')
                        <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="job_nature" class="form-label text-dark fw-bold"><i class="fas fa-briefcase me-2"></i> Job Nature</label>
                    <select class="form-control rounded-pill" name="job_nature" id="job_nature">
                        <option value="full-time" {{ $job->job_nature == 'full-time' ? 'selected' : '' }}>Full-Time</option>
                        <option value="part-time" {{ $job->job_nature == 'part-time' ? 'selected' : '' }}>Part-Time</option>
                        <option value="contract" {{ $job->job_nature == 'contract' ? 'selected' : '' }}>Contract</option>
                        <option value="temporary" {{ $job->job_nature == 'temporary' ? 'selected' : '' }}>Temporary</option>
                    </select>
                    @error('job_nature')
                        <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Salary -->
            <div class="form-group mt-3">
                <label for="salary" class="form-label text-dark fw-bold"><i class="fas fa-dollar-sign me-2"></i> Salary</label>
                <input type="number" class="form-control rounded-pill" name="salary" id="salary" value="{{ old('salary', $job->salary) }}">
                @error('salary')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Application Deadline -->
            <div class="form-group mt-3">
                <label for="application_date" class="form-label text-dark fw-bold"><i class="fas fa-clock me-2"></i> Application Deadline</label>
                <input type="date" class="form-control rounded-pill" name="application_date" id="application_date" value="{{ old('application_date', $job->application_date) }}">
                @error('application_date')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" class="special-button-blue btn-lg rounded-pill px-4 py-2">
                    <i class="fas fa-save me-2"></i>Update Job
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
