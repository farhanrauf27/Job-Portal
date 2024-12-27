<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Job;
use App\Models\Company;
use App\Mail\JobPostedNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\JobApplication;
// Store the job in the database
use App\Jobs\SendEmailJob;


class CompanyController extends Controller
{
    public function __construct()
{
    // Ensure the company is authenticated using the 'company' guard
    $this->middleware('auth:company');
}

    // Show the company dashboard view
    public function dashboard()
{
    if (Auth::guard('company')->check()) {
        $company = Auth::guard('company')->user();
        $companyLogo = $company->logo; // Assuming 'logo' is the field in the companies table

        return view('company.dashboard', compact('company', 'companyLogo',));
    } else {
        return redirect()->route('company.login');
    }
}


    // Show the job creation form
    public function createJob()
    {
        $company = Auth::guard('company')->user();
        if (!Auth::guard('company')->check()) {
            return redirect()->route('company.login');  // Redirect to login if not authenticated
        }

        return view('company.createJobs', compact('company'));  // Show the job creation form
    }

    

public function storeJob(Request $request)
{
    // Ensure the company is logged in
    if (!Auth::guard('company')->check()) {
        return redirect()->route('company.login');
    }

    // Validate and store the job data
    $request->validate([
        'job_title' => 'required|string|max:255',
        'job_description' => 'required',
        'required_skills' => 'required',
        'education_experience' => 'required',
        'category' => 'required',
        'posted_date' => 'required|date',
        'location' => 'required',
        'vacancy' => 'required|integer',
        'job_nature' => 'required',
        'salary' => 'required|numeric',
        'application_date' => 'required|date',
    ]);

    // Create the job and associate it with the logged-in company
    $job = new Job();
    $job->company_id = Auth::guard('company')->id();
    $job->job_title = $request->input('job_title');
    $job->job_description = $request->input('job_description');
    $job->required_skills = $request->input('required_skills');
    $job->education_experience = $request->input('education_experience');
    $job->category = $request->input('category');
    $job->posted_date = $request->input('posted_date');
    $job->location = $request->input('location');
    $job->vacancy = $request->input('vacancy');
    $job->job_nature = $request->input('job_nature');
    $job->salary = $request->input('salary');
    $job->application_date = $request->input('application_date');
    $job->save(); // Save the job

    // Fetch all registered users
    $users = User::all();

    // Dispatch email jobs for all users
    foreach ($users as $user) {
    $emailDetails = [
        'to' => $user->email,
        'subject' => 'New Job Posted: ' . $job->job_title,
        // Use the Blade template for the email body
        'body' => view('company.login', ['job' => $job, 'user' => $user])->render(),
    ];

    // Dispatch the job
    SendEmailJob::dispatch($user, $job); // This should work now
}


    $company = Auth::guard('company')->user();
    $jobs = Job::where('company_id', $company->id)->get();

    return view('company.showJobs', compact('company','jobs'))->with('success', 'Job posted successfully! Notifications will be sent shortly.');

}


    // Show the jobs for the logged-in company
    public function showJobs()
    {
        // Ensure the company is logged in
        if (!Auth::guard('company')->check()) {
            return redirect()->route('company.login');  // Redirect to login if not authenticated
        }

        // Fetch jobs for the logged-in company
        $company = Auth::guard('company')->user();
        $jobs = Job::where('company_id', $company->id)->get();

        // Return the view with jobs data
        return view('company.showJobs', compact('jobs','company'));
    }

    // Show the job edit form
    public function editJob($id)
{
    $job = Job::findOrFail($id);
    $company = Auth::guard('company')->user();

    // Ensure the job belongs to the logged-in company
    if ($job->company_id !== Auth::guard('company')->id()) {
        return redirect()->route('company.showJobs')->with('error', 'Unauthorized access.');
    }

    // Pass the job data to the view, where toDateString will work
    return view('company.editJob', compact('job','company'));
}




    public function updateJob(Request $request, $id)
{
    $job = Job::findOrFail($id);

    // Ensure the job belongs to the logged-in company
    if ($job->company_id !== Auth::guard('company')->id()) {
        return redirect()->route('company.showJobs')->with('error', 'Unauthorized access.');
    }

    // Validate and update the job data
    $request->validate([
        'job_title' => 'required|string|max:255',
        'job_description' => 'required',
        'required_skills' => 'required',
        'education_experience' => 'required',
        'category' => 'required',
        'posted_date' => 'required|date',
        'location' => 'required',
        'vacancy' => 'required|integer',
        'job_nature' => 'required',
        'salary' => 'required|numeric',
        'application_date' => 'required|date',
    ]);

    // Update the job details
    $job->job_title = $request->input('job_title');
    $job->job_description = $request->input('job_description');
    $job->required_skills = $request->input('required_skills');
    $job->education_experience = $request->input('education_experience');
    $job->category = $request->input('category');
    $job->posted_date = $request->input('posted_date');
    $job->location = $request->input('location');
    $job->vacancy = $request->input('vacancy');
    $job->job_nature = $request->input('job_nature');
    $job->salary = $request->input('salary');
    $job->application_date = $request->input('application_date');
    
    $job->save();

    return redirect()->route('company.showJobs')->with('success', 'Job updated successfully.');
}

    // Delete a job
    public function deleteJob($id)
    {
        // Ensure the company is logged in
        if (!Auth::guard('company')->check()) {
            return redirect()->route('company.login');  // Redirect to login if not authenticated
        }

        // Find the job by ID
        $job = Job::findOrFail($id);

        // Ensure the job belongs to the logged-in company
        if ($job->company_id !== Auth::guard('company')->id()) {
            return redirect()->route('company.showJobs')->with('error', 'Unauthorized access.');
        }

        // Delete the job
        $job->delete();

        // Redirect to the job list with a success message
        return redirect()->route('company.showJobs')->with('success', 'Job deleted successfully.');
    }


    // Profile
    public function editProfile($id)
    {
       $company = Auth::guard('company')->user(); // Get the logged-in company
    return view('company.updateProfile', compact('company')); // 
    }

    // Handle the profile update
    public function updateProfile(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'company_name' => 'required|string|max:255',
        'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Add MIME types to validate
        'company_info' => 'nullable|string',
        'email' => 'required|email',
        'phone_number' => 'nullable|string',
        'web_link' => 'nullable|url',
        'address' => 'nullable|string',
    ]);

    $company = Company::findOrFail($id);

    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $filename = uniqid() . '.' . $logo->getClientOriginalExtension();
        
        // Check if there is an existing logo and delete it
        if ($company->logo) {
            // Delete the old logo from storage
            $oldLogoPath = public_path('storage/logos/' . $company->logo);
            if (file_exists($oldLogoPath)) {
                unlink($oldLogoPath);  // Remove the old logo
            }
        }

        // Store the new logo in the storage/app/public/logos directory
        $path = $logo->storeAs('logos', $filename);

        // Update the company with the new logo path
        $company->logo = $filename;
    }

    // Update other company details
    $company->company_name = $request->company_name;
    $company->company_info = $request->company_info;
    $company->email = $request->email;
    $company->phone_number = $request->phone_number;
    $company->web_link = $request->web_link;
    $company->address = $request->address;
    $company->save();

    return redirect()->route('company.editProfile', $company->id)
                     ->with('success', 'Company profile updated successfully!');
}


// In your CompanyController
public function showApplications(Request $request)
{
    // Get the authenticated company
    $company = Auth::guard('company')->user();

    // Fetch all jobs posted by the company
    $jobs = Job::where('company_id', $company->id)->get();

    // Fetch applications based on the selected job and status
    $applicationsQuery = JobApplication::with('job', 'user')
        ->whereHas('job', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        });

    if ($request->has('job_id')) {
        $applicationsQuery->where('job_id', $request->job_id);
    }

    // Filter applications based on status (new or past)
    if ($request->get('application_status') === 'past') {
        $applicationsQuery->whereIn('status', ['accepted', 'rejected']);
    } else {
        $applicationsQuery->whereIn('status', ['submitted', 'in_review']);
    }

    // Execute the query to get the applications
    $applications = $applicationsQuery->get();

    // Pass the applications and jobs to the view
    return view('company.newApplications', compact('applications', 'jobs', 'company'));
}

public function updateApplicationStatus(Request $request, JobApplication $application)
{
    // Validate the input (ensure the status is one of the allowed values)
    $validated = $request->validate([
        'status' => 'required|in:submitted,in_review,accepted,rejected',
    ]);

    // Update the status of the application
    $application->status = $validated['status'];
    $application->save();

    // Redirect back with a success message
    return redirect()->route('company.applications')->with('success', 'Application status updated successfully.');
}

 

}
