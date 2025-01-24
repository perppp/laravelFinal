<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\AuthController;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

// Default route to show login page if user is not authenticated
Route::get('/', function () {
    // If the user is authenticated, redirect based on role
    if (Auth::check()) {
        return redirect()->route(Auth::user()->is_admin ? 'admin.dashboard' : 'jobseeker.jobs');
    }
    return view('auth.login');
})->name('login');

// Route for the register page
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// POST route for handling login form submission
Route::post('/login', [AuthController::class, 'login'])->name('login.submit'); 

// Route for handling registration form submission
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::prefix('admin')->middleware('auth', 'is_admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('jobs', [AdminController::class, 'listJobs'])->name('admin.jobs');
    Route::get('jobs/create', [AdminController::class, 'createJob'])->name('admin.create-job');
    Route::post('jobs/store', [AdminController::class, 'storeJob'])->name('admin.store-job');
    Route::get('jobs/edit/{job}', [AdminController::class, 'editJob'])->name('admin.edit-job');
    Route::post('jobs/update/{job}', [AdminController::class, 'updateJob'])->name('admin.update-job');
    Route::post('jobs/delete/{job}', [AdminController::class, 'deleteJob'])->name('admin.delete-job');
});

// Employer routes
Route::prefix('employer')->middleware('auth')->group(function () {
    Route::get('jobs', [EmployerController::class, 'listJobs'])->name('employer.jobs');
    Route::get('post-job', [EmployerController::class, 'createJob'])->name('employer.post-job');
    Route::post('store-job', [EmployerController::class, 'storeJob'])->name('employer.store-job');
});

// Jobseeker routes
Route::prefix('jobseeker')->middleware('auth')->group(function () {
    Route::get('jobs', [JobSeekerController::class, 'listAvailableJobs'])->name('jobseeker.jobs');
    Route::get('apply-job/{job}', [JobSeekerController::class, 'showApplyJobForm'])->name('jobseeker.apply-job');
    Route::post('apply-job/{job}', [JobSeekerController::class, 'applyForJob'])->name('jobseeker.submit-application');
    Route::get('my-applications', [JobSeekerController::class, 'viewMyApplications'])->name('jobseeker.my-applications');
});
