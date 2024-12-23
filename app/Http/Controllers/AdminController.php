<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Job; 
use Auth;

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


}
