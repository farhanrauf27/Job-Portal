<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Job; 
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    // Fetch the number of jobs posted in each month of the current year
    $jobsByMonth = Job::selectRaw('MONTH(posted_date) as month, COUNT(*) as total')
    ->whereYear('created_at', Carbon::now()->year)
    ->groupBy('month')
    ->orderBy('month')
    ->get();

// Fill missing months with zero
$monthsData = collect(range(1, 12))->map(function ($month) use ($jobsByMonth) {
$job = $jobsByMonth->firstWhere('month', $month);
return [
'month' => $month,
'total' => $job ? $job->total : 0,
];
});


    // Fetch jobs grouped by job category
    $jobsByCategory = Job::select('category', DB::raw('count(*) as total'))
                         ->groupBy('category')
                         ->get();

    // Fetch jobs grouped by job nature
    $jobsByNature = Job::select('job_nature', DB::raw('count(*) as total'))
                       ->groupBy('job_nature')
                       ->get();

    // Prepare data for charts
    $categoryLabels = $jobsByCategory->pluck('category')->toArray(); // Extract categories
    $categoryCounts = $jobsByCategory->pluck('total')->toArray(); // Extract job counts
    $natureLabels = array_map('ucfirst', $jobsByNature->pluck('job_nature')->toArray());
    $natureCounts = $jobsByNature->pluck('total')->toArray(); // Extract job counts for nature

    return view('admin.jobAnalytics', compact('totalJobs', 'monthsData','jobsByMonth', 'categoryLabels', 'categoryCounts', 'natureLabels', 'natureCounts', 'user'));
}

public function showUpdateProfileForm()
{
    $user = Auth::user();
    return view('admin.updateProfile', compact('user'));
}

public function updateProfile(Request $request)
{
    $user = Auth::user();

    // Validate the incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|confirmed|min:8',
    ]);

    // Update user details
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // If password is provided, hash it and update
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    return redirect()->route('admin.updateProfile')->with('success', 'Profile updated successfully');
}





}
