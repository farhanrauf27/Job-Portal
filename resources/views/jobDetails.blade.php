@extends('layouts.header')
@section('content')
<main>

    <!-- Hero Area Start-->
    <div class="slider-area">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" 
             style="background-image: url('{{ asset('assets/img/hero/about.jpg') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>{{ $job->job_title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Hero Area End -->
    <!-- job post company Start -->
    <div class="job-post-company pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Left Content -->
                <div class="col-xl-7 col-lg-8">
                    <!-- Job Single -->
                    <div class="single-job-items mb-50">
                        <div class="job-items">
                            <div class="company-img company-img-details">
                                <img src="{{ asset('storage/logos/' . $job->company->logo) }}" alt="{{ $job->company->company_name }} Logo"
                                style="width: 85px;height:85px;border:1px solid #d9d9d9">
                            </div>
                            <div class="job-tittle">
                                <h4>{{ $job->job_title }}</h4>
                                <ul>
                                    <li>{{ $job->company->company_name }}</li>
                                    <li><i class="fas fa-map-marker-alt"></i>{{ $job->location }}</li>
                                    <li>Rs. {{ number_format($job->salary, 0) }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Job Details -->
                    <div class="job-post-details">
                        <div class="post-details1 mb-50">
                            <h4>Job Description</h4>
                            <p>{{ $job->job_description }}</p>
                        </div>
                        <div class="post-details2 mb-50">
                            <h4>Required Knowledge, Skills, and Abilities</h4>
                            <ul>
                                @foreach($job->required_skills as $skill)
                                    <li>{{ $skill }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="post-details2 mb-50">
                            <h4>Education + Experience</h4>
                            <ul>
                                @foreach($job->education_experience as $edu)
                                <li>{{ $edu }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mb-50" style="text-align: center;">
                        <a href="{{ route('allJobs') }}" class="custom-btn custom-btn-primary ">Back to Job Listings</a>
                    </div>
                    
                </div>
                <!-- Right Content -->
                <div class="col-xl-4 col-lg-4">
                    <div class="post-details3 mb-50">
                        <h4>Job Overview</h4>
                        <ul>
                            <li>Posted date : <span>{{ $job->created_at->format('d M Y') }}</span></li>
                            <li>Location : <span>{{ $job->location }}</span></li>
                            <li>Vacancy : <span>{{ $job->vacancy }}</span></li>
                            <li>Job nature : <span>{{ ucfirst($job->job_nature) }}
                            </span></li>
                            <li>Salary : <span>Rs. {{ number_format($job->salary, 0) }}</span></li>
                            <li>Application date: <span>{{ \Carbon\Carbon::parse($job->application_date)->format('d M Y') }}</span></li>
                        </ul>
                        <div class="apply-btn2">
                            @if(auth()->check())
                                <!-- Button for logged-in users -->
                                <a href="{{ route('job.apply', $job->id) }}" class="btn5">Apply Now</a>
                            @else
                                <!-- Disabled button with tooltip for non-logged-in users -->
                                <a href="javascript:void(0)" class="btn disabled" data-tooltip="You need to log in first to apply">Apply Now</a>
                                <div>
                                <a style="color:red;">You need to log in first to apply</a>
                                </div>
                            @endif
                        </div>
                        <style>
                            .apply-btn2 {
    position: relative;
    display: inline-block;
}

.btn5 {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    color: white;
    background-color: #007bff;
    border-radius: 8px;
    text-decoration: none;
    transition: background-color 0.3s ease;
    cursor: pointer;
}

.btn5:hover {
    background-color: #0056b3;
}

.btn5.disabled {
    background-color: #ccc;
    cursor: not-allowed;
    pointer-events: none;
}

/* Tooltip Styling */

                        </style>
                        
                    </div>
                    <div class="post-details4 mb-50">
                        <h4>Company Information</h4>
                        <span>{{ $job->company->company_name }}</span>
                        <p>{{ $job->company->company_info }}</p>
                        <ul>
                            <li>Name: <span>{{ $job->company->company_name }}</span></li>
                            <li>Web : <span><a href="{{ $job->company->web_link }}" target="_blank" style="color: #506172">{{ $job->company->web_link }}</a></span></li>
                            <li>Email: <span>{{ $job->company->email }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job post company End -->

</main>
@endsection