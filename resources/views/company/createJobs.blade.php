@extends('layouts.companyNav')

@section('content')
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            alert("{{ session('success') }}");
        });
    </script>
@endif

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-primary text-white text-center">
                    <h3 class="mb-0"><i class="fas fa-briefcase"></i> Create a New Job</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('company.storeJob') }}" method="POST">
                        @csrf {{-- CSRF token for form security --}}
                        
                        <!-- Job Title -->
                        <div class="mb-3">
                            <label for="job_title" class="form-label fw-bold">Job Title</label>
                            <input type="text" class="form-control form-control-lg rounded-pill" name="job_title" id="job_title" placeholder="Enter job title" required>
                        </div>
                        
                        <!-- Job Description -->
                        <div class="mb-3">
                            <label for="job_description" class="form-label fw-bold">Job Description</label>
                            <textarea name="job_description" id="job_description" class="form-control rounded-lg" rows="4" placeholder="Provide a detailed description" required></textarea>
                        </div>
                        
                        <!-- Required Skills -->
                        <div class="mb-3">
                            <label for="required_skills" class="form-label fw-bold">Required Knowledge, Skills, and Abilities</label>
                            <textarea name="required_skills" id="required_skills" class="form-control rounded-lg" rows="3" placeholder="List the skills required" required></textarea>
                        </div>
                        
                        <!-- Education & Experience -->
                        <div class="mb-3">
                            <label for="education_experience" class="form-label fw-bold">Education & Experience</label>
                            <textarea name="education_experience" id="education_experience" class="form-control rounded-lg" rows="3" placeholder="Specify the qualifications and experience needed" required></textarea>
                        </div>
                        
                        <!-- Dates -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="posted_date" class="form-label fw-bold">Posted Date</label>
                                <input type="date" name="posted_date" id="posted_date" class="form-control form-control-lg rounded-pill" readonly required>
                            </div>
                            
                            <script>
                                // Get today's date in YYYY-MM-DD format
                                const today = new Date().toISOString().split("T")[0];
                            
                                // Set the value of the posted_date field to today's date
                                const postedDateInput = document.getElementById("posted_date");
                                postedDateInput.value = today;
                            </script>
                            
                            <div class="col-md-6 mb-3">
                                <label for="application_date" class="form-label fw-bold">Application Deadline</label>
                                <input type="date" name="application_date" id="application_date" class="form-control form-control-lg rounded-pill" required>
                            </div>
                            
                            <script>
                                // Get today's date in YYYY-MM-DD format
                                const todayx = new Date().toISOString().split("T")[0];
                            
                                // Set the minimum date attribute
                                const applicationDateInput = document.getElementById("application_date");
                                applicationDateInput.setAttribute("min", todayx);
                            </script>
                            
                        </div>
                        
                        <!-- Location and Vacancy -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label fw-bold">Location</label>
                                <input type="text" name="location" id="location" class="form-control form-control-lg rounded-pill" placeholder="Enter job location" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="vacancy" class="form-label fw-bold">Vacancy</label>
                                <input type="number" name="vacancy" id="vacancy" class="form-control form-control-lg rounded-pill" placeholder="Number of vacancies" required>
                            </div>
                        </div>
                        
                        <!-- Job Nature and Salary -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="job_nature" class="form-label fw-bold">Job Nature</label>
                                <select name="job_nature" id="job_nature" class="form-control form-control-lg rounded-pill" required>
                                    <option value="" disabled selected>Select job nature</option>
                                    <option value="Full-Time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Internship">Internship</option>
                                    <option value="Remote">Remote</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="salary" class="form-label fw-bold">Salary</label>
                                <input type="number" name="salary" id="salary" class="form-control form-control-lg rounded-pill" placeholder="Enter salary range" required>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="special-button-blue btn-lg rounded-pill px-4 py-2">
                                <i class="fas fa-save"></i> Create Job
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
