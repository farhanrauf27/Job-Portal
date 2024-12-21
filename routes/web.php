<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






// admin

use App\Http\Middleware\CheckAdmin;

Route::middleware(['auth', CheckAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard route
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('users', [AdminController::class, 'showUsers'])->name('users');
});





// Company
Route::prefix('company')->name('company.')->group(function () {
    Route::get('dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');
   
});

