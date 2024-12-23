<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job; // Assuming you have a Job model

class UserController extends Controller
{
    public function index()
    {
        $jobs = Job::with('company')->take(3)->get(); // Fetch all jobs from the database
        return view('welcome', compact('jobs')); // Pass jobs to the view
    }

    public function allJobs(Request $request)
    {
        $jobs = Job::with('company');  // Start with all jobs
    
        // Get the selected job types from the request
        $selectedJobTypes = $request->input('job_types');
        
        if ($selectedJobTypes) {
            $jobTypesArray = explode(',', $selectedJobTypes);  // Convert the comma-separated string into an array
            
            // Filter jobs by selected job types
            $jobs = $jobs->whereIn('job_nature', $jobTypesArray);
        }
    
        // Apply sorting (if any)
        $sortBy = $request->input('sort_by');  // Get the sorting criteria from the request
        switch ($sortBy) {
            case 'name':
                $jobs = $jobs->orderBy('job_title');
                break;
            case 'time':
                $jobs = $jobs->orderBy('created_at', 'desc');
                break;
            case 'salary':
                $jobs = $jobs->orderBy('salary', 'desc');
                break;
        }
    
        // Paginate the results (7 jobs per page)
        $jobs = $jobs->paginate(7);  // Fetch paginated results
    
        // Get the total number of jobs (for the count display)
        $totalJobs = Job::count(); 
    
        return view('jobList', compact('jobs', 'totalJobs'));  // Pass jobs and totalJobs to the view
    }
    

}
