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


use App\Http\Controllers\CompanyAuthController;

Route::get('/company/register', [CompanyAuthController::class, 'showRegisterForm'])->name('company.register');
Route::post('/company/register', [CompanyAuthController::class, 'register']);
Route::get('/company/login', [CompanyAuthController::class, 'showLoginForm'])->name('company.login');
Route::post('/company/login', [CompanyAuthController::class, 'login']);
Route::post('/company/logout', [CompanyAuthController::class, 'logout'])->name('company.logout');
Route::get('/companydashboard', [CompanyController::class, 'dashboard'])->name('company.dashboard');

    // Route::get('/companycreate-job', [CompanyController::class, 'createJob'])->name('company.createJob');
    // Route::post('/companystore-job', [CompanyController::class, 'storeJob'])->name('company.storeJob');

    // Route::middleware(['auth:company'])->group(function () {
    //     Route::get('/company/jobs', [CompanyController::class, 'showJobs'])->name('company.showJobs');
    //     Route::get('/company/jobs/{id}/edit', [CompanyController::class, 'editJob'])->name('company.editJob');
    //     Route::delete('/company/jobs/{id}', [CompanyController::class, 'deleteJob'])->name('company.deleteJob');
    // });

    Route::middleware(['auth:company'])->group(function () {
        Route::get('/company/jobs', [CompanyController::class, 'showJobs'])->name('company.showJobs');
        Route::get('/company/create-job', [CompanyController::class, 'createJob'])->name('company.createJob');
        Route::post('/company/store-job', [CompanyController::class, 'storeJob'])->name('company.storeJob');
        Route::get('/company/jobs/{id}/edit', [CompanyController::class, 'editJob'])->name('company.editJob');
        Route::delete('/company/jobs/{id}', [CompanyController::class, 'deleteJob'])->name('company.deleteJob');
        Route::put('/company/jobs/{id}', [CompanyController::class, 'updateJob'])->name('company.updateJob');
        Route::get('/company/{id}/update-profile', [CompanyController::class, 'editProfile'])->name('company.editProfile');
        Route::put('/company/{id}/update-profile', [CompanyController::class, 'updateProfile'])->name('company.updateProfile');
    });