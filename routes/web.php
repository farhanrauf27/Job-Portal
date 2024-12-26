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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






// admin

use App\Http\Middleware\CheckAdmin;

Route::middleware(['auth', CheckAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard route
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('users', [AdminController::class, 'showUsers'])->name('users');
    Route::delete('users/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
    Route::get('jobs', [AdminController::class, 'showJobs'])->name('jobs');
    Route::delete('jobs/{job}', [AdminController::class, 'deleteJob'])->name('deleteJob');
    Route::get('jobs/{id}', [AdminController::class, 'viewJob'])->name('viewJob');
    Route::get('job-analytics', [AdminController::class, 'showJobAnalytics'])->name('analytics');
    Route::get('updateProfile', [AdminController::class, 'showUpdateProfileForm'])->name('updateProfileForm');
    Route::put('updateProfile', [AdminController::class, 'updateProfile'])->name('updateProfile');




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
        Route::put('/company/application/{application}/update-status', [CompanyController::class, 'updateApplicationStatus'])->name('company.updateApplicationStatus');
    });

    Route::middleware(['auth:company'])->get('/company/newApplications', [CompanyController::class, 'showApplications'])->name('company.applications');




    // User
    use App\Http\Controllers\UserController;

    Route::get('/', [UserController::class, 'index'])->name('jobs');
    Route::get('/allJobs', [UserController::class, 'allJobs'])->name('allJobs');
    Route::get('/allJobs/sort', [UserController::class, 'allJobs'])->name('allJobs.sort');
    Route::get('/job_details/{id}', [UserController::class, 'showJobDetails'])->name('job.details');
    use App\Http\Controllers\JobApplicationController;

Route::middleware('auth')->group(function () {
    Route::get('/job/{id}/apply', [JobApplicationController::class, 'show'])->name('job.apply');
    Route::post('/job/{id}/apply', [JobApplicationController::class, 'store'])->name('job.store');
});
Route::get('/my-applications', [JobApplicationController::class, 'myApplications'])->name('myApplications');

