<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Job;
use App\Models\Company;

class CompanyController extends Controller
{
    // Show the company dashboard view
    public function dashboard()
    {
        if (Auth::guard('company')->check()) {
            $company = Auth::guard('company')->user();
            return view('company.dashboard', compact('company'));
        } else {
            return redirect()->route('company.login');
        }
    }

    // Show the job creation form
    public function createJob()
    {
        // Ensure the company is logged in
        if (!Auth::guard('company')->check()) {
            return redirect()->route('company.login');  // Redirect to login if not authenticated
        }

        return view('company.createJobs');  // Show the job creation form
    }

    // Store the job in the database
    public function storeJob(Request $request)
    {
        // Ensure the company is logged in
        if (!Auth::guard('company')->check()) {
            return redirect()->route('company.login');  // Redirect to login if not authenticated
        }

        // Validate and store the job data
        $request->validate([
            'job_title' => 'required|string|max:255',
            'job_description' => 'required',
            'required_skills' => 'required',
            'education_experience' => 'required',
            'posted_date' => 'required|date',
            'location' => 'required',
            'vacancy' => 'required|integer',
            'job_nature' => 'required',
            'salary' => 'required|numeric',
            'application_date' => 'required|date',
        ]);

        // Create the job and associate with the logged-in company
        $job = new Job();
        $job->company_id = Auth::guard('company')->id(); // Set the company ID
        $job->job_title = $request->input('job_title');
        $job->job_description = $request->input('job_description');
        $job->required_skills = $request->input('required_skills');
        $job->education_experience = $request->input('education_experience');
        $job->posted_date = $request->input('posted_date');
        $job->location = $request->input('location');
        $job->vacancy = $request->input('vacancy');
        $job->job_nature = $request->input('job_nature');
        $job->salary = $request->input('salary');
        $job->application_date = $request->input('application_date');
        
        $job->save();  // Save the job

        return redirect()->route('company.showJobs')->with('success', 'Job created successfully.');
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
        return view('company.showJobs', compact('jobs'));
    }

    // Show the job edit form
    public function editJob($id)
{
    $job = Job::findOrFail($id);
    
    // Ensure the job belongs to the logged-in company
    if ($job->company_id !== Auth::guard('company')->id()) {
        return redirect()->route('company.showJobs')->with('error', 'Unauthorized access.');
    }

    // Pass the job data to the view, where toDateString will work
    return view('company.editJob', compact('job'));
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
        'logo' => 'nullable|file|max:2048', // Adjusted validation rule
        'company_info' => 'nullable|string',
        'email' => 'required|email',
        'phone_number' => 'nullable|string',
        'web_link' => 'nullable|url',
        'address' => 'nullable|string',
    ]);

    // Find the company by id
    $company = Company::findOrFail($id);

    // If logo is uploaded, store it
    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $filename = uniqid() . '.' . $logo->getClientOriginalExtension();
        
        // Define the directory path
        $directory = public_path('storage/logos/');
        
        // Ensure the directory exists
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true); // Create directory with permissions
        }
        
        // Save the file manually
        $path = $directory . $filename;
        file_put_contents($path, file_get_contents($logo));
        
        // Save filename to the database
        $company->logo = $filename;
    }
    
    

    // Update the company fields
    $company->company_name = $request->company_name;
    $company->company_info = $request->company_info;
    $company->email = $request->email;
    $company->phone_number = $request->phone_number;
    $company->web_link = $request->web_link;
    $company->address = $request->address;
    $company->logo = $request->logo;
    $company->save();

    return redirect()->route('company.editProfile', $company->id)
                     ->with('success', 'Company profile updated successfully!');
}

}
