<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Job; 
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin dashboard view
    public function dashboard()
    {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }
    public function showUsers()
    {
        $user = Auth::user();
        $users = User::where('type', 0)->get();
        return view('admin.users', compact('users','user'));
    }
    public function deleteUser($id)
{
    // Find the user by ID
    $user = User::find($id);

    // Check if the user exists
    if ($user) {
        // Delete the user
        $user->delete();

        // Redirect back with success message
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    } else {
        // If user not found, redirect with an error message
        return redirect()->route('admin.users')->with('error', 'User not found');
    }
}

public function showJobs()
{
    $user = Auth::user();
    $jobs = Job::with('company')->get();  // Eager load the company relation

    return view('admin.jobs', compact('jobs','user'));  // Return the jobs to the 'admin.jobs' view
}
public function deleteJob($jobId)
{
    $job = Job::findOrFail($jobId);
    $job->delete();

    return redirect()->route('admin.jobs')->with('success', 'Job deleted successfully.');
}
public function viewJob($id)
{
    // Find the job by ID
    $job = Job::findOrFail($id);
    $user = Auth::user();

    // Return a view with the job details
    return view('admin.jobDetails', compact('job','user'));
}

public function showJobAnalytics()
{
    $user = Auth::user();
    $totalJobs = Job::count();

    // Fetch the number of jobs posted each month (last 12 months)
    $jobsByMonth = Job::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                      ->where('created_at', '>=', Carbon::now()->subYear())
                      ->groupBy('month')
                      ->orderBy('month')
                      ->get();

    // Fetch jobs grouped by job category
    $jobsByCategory = Job::select('category', DB::raw('count(*) as total'))
                         ->groupBy('category')
                         ->get();

    // Prepare category data for chart
    $categoryLabels = $jobsByCategory->pluck('category')->toArray(); // Extract categories
    $categoryCounts = $jobsByCategory->pluck('total')->toArray(); // Extract job counts

    return view('admin.jobAnalytics', compact('totalJobs', 'jobsByMonth', 'categoryLabels', 'categoryCounts', 'user'));
}




}
