<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('company.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:companies',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Company::create([
            'company_name' => $request->company_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('company.login')->with('success', 'Registration successful! Please log in.');
    }

    public function showLoginForm()
    {
        return view('company.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('company')->attempt($credentials)) {
            return redirect()->route('company.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::guard('company')->logout();
        return redirect()->route('company.login')->with('success', 'Logged out successfully.');
    }
}
