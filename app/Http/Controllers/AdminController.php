<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin dashboard view
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function showUsers()
    {
        $users = User::where('type', 0)->get();
        return view('admin.users', compact('users'));
    }
}
