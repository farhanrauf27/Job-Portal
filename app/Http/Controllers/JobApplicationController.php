<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    public function show($id)
    {
        // Check if the user has already applied for this job
        $hasApplied = JobApplication::where('job_id', $id)
            ->where('user_id', auth()->id())
            ->exists();

        return view('apply', compact('id', 'hasApplied'));
    }

    public function store(Request $request, $id)
    {
        // Check if the user has already applied
        $hasApplied = JobApplication::where('job_id', $id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($hasApplied) {
            return redirect()->back()->with('error', 'You have already submitted an application for this job.');
        }

        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048', // Validate file type and size
        ]);

        // Store the uploaded file
        $path = $request->file('cv')->store('cvs', 'public');

        // Save details to the database
        JobApplication::create([
            'job_id' => $id,
            'user_id' => auth()->id(),
            'cv_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Your application has been submitted.');
    }
    public function myApplications()
{
    // Fetch the logged-in user's applications with related job details
    $applications = JobApplication::where('user_id', auth()->id())->with('job')->get();

    return view('my-applications', compact('applications'));
}
}
