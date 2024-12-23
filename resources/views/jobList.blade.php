<x-bootstrap/>
@extends('layouts.header')
@section('content')

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
                           <div class="small-section-tittle2">
                                 <h4>Job Category</h4>
                           </div>
                            <!-- Select job items start -->
                            <div class="select-job-items2">
                                <select name="select">
                                    <option value="">All Category</option>
                                    <option value="">Category 1</option>
                                    <option value="">Category 2</option>
                                    <option value="">Category 3</option>
                                    <option value="">Category 4</option>
                                </select>
                            </div>
                            <!--  Select job items End-->
                            <!-- select-Categories start -->
                            <div class="select-Categories pt-80 pb-50">
                                <div class="small-section-tittle2">
                                    <h4>Job Type</h4>
                                </div>
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
                                // Function to filter jobs when checkboxes are changed
                                function filterJobs() {
                                    let selectedJobTypes = [];
                                    // Get all checked checkboxes
                                    document.querySelectorAll('.job-type:checked').forEach(function(checkbox) {
                                        selectedJobTypes.push(checkbox.value);
                                    });
                            
                                    // Send the selected job types to the server via URL query parameters
                                    const url = new URL(window.location.href);
                                    url.searchParams.set('job_types', selectedJobTypes.join(','));
                                    window.location.href = url.toString();  // Redirect to the updated URL with query parameters
                                }
                            
                                // Add event listeners to the checkboxes to trigger the filterJobs function when the user changes a selection
                                document.querySelectorAll('.job-type').forEach(function(checkbox) {
                                    checkbox.addEventListener('change', filterJobs);
                                });
                            
                                // On page load, check the checkboxes based on the URL parameters
                                window.addEventListener('load', function() {
                                    const urlParams = new URLSearchParams(window.location.search);
                                    const selectedJobTypes = urlParams.get('job_types');
                                    
                                    if (selectedJobTypes) {
                                        const selectedTypesArray = selectedJobTypes.split(',');
                                        document.querySelectorAll('.job-type').forEach(function(checkbox) {
                                            if (selectedTypesArray.includes(checkbox.value)) {
                                                checkbox.checked = true;
                                            }
                                        });
                                    }
                                });
                            </script>
                            
                            
                            
                            <!-- select-Categories End -->
                        </div>
                        <!-- single two -->
                        <div class="single-listing">
                           <div class="small-section-tittle2">
                                 <h4>Job Location</h4>
                           </div>
                            <!-- Select job items start -->
                            <div class="select-job-items2">
                                <select name="select">
                                    <option value="">Anywhere</option>
                                    <option value="">Category 1</option>
                                    <option value="">Category 2</option>
                                    <option value="">Category 3</option>
                                    <option value="">Category 4</option>
                                </select>
                            </div>
                            <!--  Select job items End-->
                            <!-- select-Categories start -->
                            <div class="select-Categories pt-80 pb-50">
                                <div class="small-section-tittle2">
                                    <h4>Experience</h4>
                                </div>
                                <label class="container">1-2 Years
                                    <input type="checkbox" >
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">2-3 Years
                                    <input type="checkbox" checked="checked active">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">3-6 Years
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">6-more..
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <!-- select-Categories End -->
                        </div>
                        <!-- single three -->
                        <div class="single-listing">
                            <!-- select-Categories start -->
                            <div class="select-Categories pb-50">
                                <div class="small-section-tittle2">
                                    <h4>Posted Within</h4>
                                </div>
                                <label class="container">Any
                                    <input type="checkbox" >
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Today
                                    <input type="checkbox" checked="checked active">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Last 2 days
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Last 3 days
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Last 5 days
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Last 10 days
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <!-- select-Categories End -->
                        </div>
                        <div class="single-listing">
                            <!-- Range Slider Start -->
                            <aside class="left_widgets p_filter_widgets price_rangs_aside sidebar_box_shadow">
                                <div class="small-section-tittle2">
                                    <h4>Filter Jobs</h4>
                                </div>
                                <div class="widgets_inner">
                                    <div class="range_item">
                                        <!-- <div id="slider-range"></div> -->
                                        <input type="text" class="js-range-slider" value="" />
                                        <div class="d-flex align-items-center">
                                            <div class="price_text">
                                                <p>Price :</p>
                                            </div>
                                            <div class="price_value d-flex justify-content-center">
                                                <input type="text" class="js-input-from" id="amount" readonly />
                                                <span>to</span>
                                                <input type="text" class="js-input-to" id="amount" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                          <!-- Range Slider End -->
                        </div>
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
                                        <div class="select-job-items">
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
                <a href="job_details/{{ $job->id }}"><h4>{{ $job->job_title }}</h4></a>
                <ul>
                    <li><i class="fas fa-building"></i> {{ $job->company->company_name }}</li>
                    <li><i class="fas fa-map-marker-alt"></i>{{ $job->location }}</li>
                    <li>${{ $job->salary }}</li>
                </ul>
            </div>
        </div>
        <div class="items-link f-right">
            <a href="job_details/{{ $job->id }}">{{ $job->job_nature }}</a>
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