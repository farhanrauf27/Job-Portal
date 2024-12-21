<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CompanyController extends Controller
{
    public function dashboard()
    {
        // Check if the user is logged in and if the user type is '2' (Company)
        if (Auth::check() && Auth::user()->type == 2) {
            return view('company.dashboard');  // Show the company dashboard view
        }

        // If user is not authenticated or not a company, redirect to home or another page
        return redirect()->route('home');
    }

   
}

