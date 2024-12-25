@extends('layouts.header')
@section('content')
<style>
    .stylish-select {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    color: #333;
}

.stylish-select span {
    font-weight: bold;
    color: #555;
}

.stylish-select select {
    padding: 10px 15px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: linear-gradient(145deg, #f3f3f3, #e8e8e8);
    color: #333;
    outline: none;
    transition: 0.3s ease-in-out;
    box-shadow: 2px 2px 5px #ddd, -2px -2px 5px #fff;
}

.stylish-select select:hover {
    background: linear-gradient(145deg, #e8e8e8, #f3f3f3);
    border-color: #aaa;
}

.stylish-select select:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.stylish-select select option {
    font-size: 14px;
    color: #333;
}

</style>
<main>

    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" style="background-image: url('{{ asset('assets/img/hero/about.jpg') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Get your job</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    <div class="row mt-5 text-center justify-content-center">
        <div class="col-xl-8 ">
            <!-- form -->
            <form action="{{ route('allJobs') }}" method="GET" class="search-box">
                <div class="input-form">
                    <input type="text" name="keyword" placeholder="Job Title or keyword" value="{{ request('keyword') }}" style="width: 100%; padding: 10px;">
                </div>
                <div class="select-form">
                    <div class="select-items">
                        <select name="location" id="select1" style="height: 70px; width: 100%; color: #777777; font-size: 18px; font-weight: 400; padding: 9px 33px 9px 32px; border: none; border-radius: 0px; position: relative; outline:none">
                            <option value="">Select Location</option>
                            <option value="Karachi" {{ request('location') == 'Karachi' ? 'selected' : '' }}>Karachi</option>
                            <option value="Lahore" {{ request('location') == 'Lahore' ? 'selected' : '' }}>Lahore</option>
                            <option value="Islamabad" {{ request('location') == 'Islamabad' ? 'selected' : '' }}>Islamabad</option>
                            <option value="Rawalpindi" {{ request('location') == 'Rawalpindi' ? 'selected' : '' }}>Rawalpindi</option>
                        </select>
                    </div>
                </div>
                <div class="search-form">
                    <button class="btn" type="submit" style="width: 100%;height: 70px; padding: 10px;">Find job</button>
                </div>
            </form>
        </div>
    </div>
    
    
    <!-- Job List Area Start -->
    <div class="job-listing-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <!-- Left content -->
                <div class="col-xl-3 col-lg-3 col-md-4">
                    <div class="row">
                        <div class="col-12">
                                <div class="small-section-tittle2 mb-45">
                                <div class="ion"> <svg 
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="20px" height="12px">
                                <path fill-rule="evenodd"  fill="rgb(27, 207, 107)"
                                    d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z"/>
                                </svg>
                                </div>
                                <h4>Filter Jobs</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Job Category Listing start -->
                    <div class="job-category-listing mb-50">
                        <!-- single one -->
                        <div class="single-listing">
                          
                            <!-- Select job items start -->
                            
                            <!--  Select job items End-->
                            <!-- select-Categories start -->
                            <div class="select-Categories pb-30">
                                <div class="small-section-tittle2">
                                    <h4>Job Type</h4>
                                </div>
                                <label class="container">All
                                    <input type="checkbox" class="job-type" value="All" id="all-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Full Time
                                    <input type="checkbox" class="job-type" value="full-Time">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Part Time
                                    <input type="checkbox" class="job-type" value="Part-time">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Internship
                                    <input type="checkbox" class="job-type" value="Internship">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Contract
                                    <input type="checkbox" class="job-type" value="Contract">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Remote
                                    <input type="checkbox" class="job-type" value="Remote">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            
                            <script>
    // Function to filter jobs based on selected checkboxes
    function filterJobs() {
        const allCheckbox = document.getElementById('all-checkbox');
        const jobTypeCheckboxes = document.querySelectorAll('.job-type:not(#all-checkbox)');

        let selectedJobTypes = [];

        if (allCheckbox.checked) {
            // If "All" is checked, deselect all other checkboxes
            jobTypeCheckboxes.forEach((checkbox) => (checkbox.checked = false));
            selectedJobTypes.push('All');
        } else {
            // If "All" is not checked, collect all checked job type checkboxes
            jobTypeCheckboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    selectedJobTypes.push(checkbox.value);
                }
            });
        }

        // Update the query parameter and reload the page
        const url = new URL(window.location.href);
        url.searchParams.set('job_types', selectedJobTypes.join(','));
        window.location.href = url.toString(); // Redirect with updated parameters
    }

    // Add event listeners to checkboxes
    document.querySelectorAll('.job-type').forEach((checkbox) => {
        checkbox.addEventListener('change', () => {
            if (checkbox.id !== 'all-checkbox') {
                // If a job type checkbox is checked, uncheck "All"
                document.getElementById('all-checkbox').checked = false;
            }
            filterJobs();
        });
    });

    // On page load, check the correct checkboxes based on URL parameters
    window.addEventListener('load', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const selectedJobTypes = urlParams.get('job_types');
        const allCheckbox = document.getElementById('all-checkbox');
        const jobTypeCheckboxes = document.querySelectorAll('.job-type:not(#all-checkbox)');

        if (selectedJobTypes) {
            const selectedTypesArray = selectedJobTypes.split(',');

            // Mark the correct checkboxes as checked
            jobTypeCheckboxes.forEach((checkbox) => {
                checkbox.checked = selectedTypesArray.includes(checkbox.value);
            });

            // Handle the "All" checkbox state
            allCheckbox.checked = selectedTypesArray.includes('All');

            if (allCheckbox.checked) {
                // Uncheck all other checkboxes if "All" is selected
                jobTypeCheckboxes.forEach((checkbox) => (checkbox.checked = false));
            }
        } else {
            // Default to "All" if no types are selected
            allCheckbox.checked = true;
        }
    });
</script>
                            
                            
                            
                            
                            <!-- select-Categories End -->
                        </div>
                        <!-- single two -->
                        <div class="single-listing">
                           
                            <!-- Select job items start -->
                            
                            <!--  Select job items End-->
                            <!-- select-Categories start -->
                           
                            <!-- select-Categories End -->
                        </div>
                        <!-- single three -->
                        <div class="single-listing">
                            <!-- select-Categories start -->
                            <div class="select-Categories pb-50">
                                <form id="postedWithinForm" action="{{ route('allJobs') }}" method="GET">
                                    <div class="small-section-tittle2">
                                        <h4>Posted Within</h4>
                                    </div>
                                    <label class="container">Any
                                        <input type="radio" name="posted_within" value="any" 
                                            {{ request('posted_within') == 'any' || !request('posted_within') ? 'checked' : '' }} 
                                            onchange="submitForm()">
                                        <span class="checkmark"></span>
                                    </label>
                                    
                                    <label class="container">Today
                                        <input type="radio" name="posted_within" value="today" {{ request('posted_within') == 'today' ? 'checked' : '' }} onchange="submitForm()">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 2 days
                                        <input type="radio" name="posted_within" value="2" {{ request('posted_within') == '2' ? 'checked' : '' }} onchange="submitForm()">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 3 days
                                        <input type="radio" name="posted_within" value="3" {{ request('posted_within') == '3' ? 'checked' : '' }} onchange="submitForm()">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 5 days
                                        <input type="radio" name="posted_within" value="5" {{ request('posted_within') == '5' ? 'checked' : '' }} onchange="submitForm()">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 10 days
                                        <input type="radio" name="posted_within" value="10" {{ request('posted_within') == '10' ? 'checked' : '' }} onchange="submitForm()">
                                        <span class="checkmark"></span>
                                    </label>
                                </form>
                            </div>
                            <!-- select-Categories End -->
                        </div>
                        <script>
                            function submitForm() {
                                document.getElementById('postedWithinForm').submit();
                            }
                        </script>
                        {{-- Categories                         --}}
                        <div class="single-listing">
                            <!-- select-Categories start -->
                            <div class="select-Categories pb-50">
                                <form id="categoryForm" action="{{ route('allJobs') }}" method="GET">
                                    <div class="small-section-tittle2">
                                        <h4>Categories</h4>
                                    </div>
                                    <label class="container">Any
                                        <input type="radio" name="category" value="any"
                                            {{ !request('category') || request('category') == 'any' ? 'checked' : '' }} 
                                            onchange="submitCategoryForm()">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Design & Creative
                                        <input type="radio" name="category" value="Design & Creative"
                                            {{ request('category') == 'Design & Creative' ? 'checked' : '' }} 
                                            onchange="submitCategoryForm()">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Design & Development
                                        <input type="radio" name="category" value="Design & Development"
                                            {{ request('category') == 'Design & Development' ? 'checked' : '' }} 
                                            onchange="submitCategoryForm()">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Sales & Marketing
                                        <input type="radio" name="category" value="Sales & Marketing"
                                            {{ request('category') == 'Sales & Marketing' ? 'checked' : '' }} 
                                            onchange="submitCategoryForm()">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Mobile Application
                                        <input type="radio" name="category" value="Mobile Application"
                                            {{ request('category') == 'Mobile Application' ? 'checked' : '' }} 
                                            onchange="submitCategoryForm()">
                                        <span class="checkmark"></span>
                                    </label>
                                </form>
                            </div>
                            <!-- select-Categories End -->
                        </div>
                        <script>
                            function submitCategoryForm() {
                                document.getElementById('categoryForm').submit();
                            }
                        </script>
                        
                        
                        
                    </div>
                    <!-- Job Category Listing End -->
                </div>
                <!-- Right content -->
                <div class="col-xl-9 col-lg-9 col-md-8">
                    <!-- Featured_job_start -->
                    <section class="featured-job-area">
                        <div class="container">
                            <!-- Count of Job list Start -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="count-job mb-35">
                                        <span>{{ $totalJobs }} Jobs found</span>

                                        <!-- Select job items start -->
                                        <div class="select-job-items stylish-select">
                                            <span>Sort by</span>
                                            <select name="select" id="job-sort" onchange="sortJobs()">
                                                <option value="name" {{ request()->get('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                                                <option value="time" {{ request()->get('sort_by') == 'time' ? 'selected' : '' }}>Time</option>
                                                <option value="salary" {{ request()->get('sort_by') == 'salary' ? 'selected' : '' }}>Salary</option>
                                            </select>
                                        </div>
                                        
                                        
                                        <script>
                                            function sortJobs() {
                                                const sortBy = document.getElementById('job-sort').value; // Get the selected value
                                                window.location.href = `/allJobs/sort?sort_by=${sortBy}`;  // Redirect to the sorted page
                                            }
                                        </script>
                                        <!--  Select job items End-->
                                    </div>
                                </div>
                            </div>
                            <!-- Count of Job list End -->
                            <!-- single-job-content -->
                            @foreach($jobs as $job)
    <div class="single-job-items mb-30">
        <div class="job-items">
            <div class="company-img">
                <a href="job_details.html">
                    <img src="{{ asset('storage/logos/' . $job->company->logo) }}" alt="{{ $job->company->company_name }} Logo"
                    style="width: 85px;height:85px; border:1px solid #d9d9d9">
                </a>
            </div>

            <div class="job-tittle">
                <a href="{{ route('job.details', $job->id) }}"><h4>{{ $job->job_title }}</h4></a>
                <ul>
                    <li><i class="fas fa-building"></i> {{ $job->company->company_name }}</li>
                    <li><i class="fas fa-map-marker-alt"></i>{{ $job->location }}</li>
                    <li>Rs. {{ number_format($job->salary, 0) }}</li>
                </ul>
            </div>
        </div>
        <div class="items-link f-right">
            <a href="{{ route('job.details', $job->id) }}">{{ ucfirst($job->job_nature) }}
            </a>
            <span>{{ $job->created_at->diffForHumans() }}</span>
        </div>
    </div>
    <hr style="border: 1px solid #d9d9d9; margin-top: 15px; margin-bottom: 15px;">
@endforeach

<!-- Pagination Links -->
<div class="pagination-info text-center mb-4">
    <p>
        Showing 
        <strong>{{ $jobs->firstItem() }}</strong> 
        to 
        <strong>{{ $jobs->lastItem() }}</strong> 
        of 
        <strong>{{ $jobs->total() }}</strong> 
        jobs
    </p>
</div>

<div class="pagination justify-content-center">
    {{ $jobs->links('pagination::bootstrap-4') }}
</div>



                            <!-- single-job-content -->
                           
                        </div>
                    </section>
                    <!-- Featured_job_end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Job List Area End -->
   
    
</main>

@endsection