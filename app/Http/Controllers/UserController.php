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
        $jobs = Job::with('company');  
        $keyword = $request->input('keyword');
    if ($keyword) {
        // Filter jobs by keyword (title or description, etc.)
        $jobs = $jobs->where('job_title', 'LIKE', "%{$keyword}%")
                     ->orWhere('job_description', 'LIKE', "%{$keyword}%");
    }

    // Get the selected location from the request
    $location = $request->input('location');
    if ($location) {
        $jobs = $jobs->whereHas('company', function($query) use ($location) {
            $query->where('location', 'LIKE', "%{$location}%");
        });
    }
    $postedWithin = $request->input('posted_within');

    if ($postedWithin && $postedWithin !== 'any') {
        if ($postedWithin === 'today') {
            // Filter jobs created today
            $jobs = $jobs->whereDate('created_at', now()->toDateString());
        } else {
            // Convert to integer for numeric filters like "last 2 days"
            $days = (int) $postedWithin;
            $jobs = $jobs->where('created_at', '>=', now()->subDays($days));
        }
    }

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
    public function showJobDetails($id)
{
    $job = Job::with('company')->findOrFail($id);
    $job->required_skills = explode("\n", $job->required_skills);
    $job->education_experience = explode("\n", $job->education_experience);
    return view('jobDetails', compact('job'));
}


}
