<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobSeekerController;
use App\Models\Job;

Route::get('/', function () {
    $jobs = Job::all();
    return view('jobseeker.jobs', compact('jobs'));
});

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('jobs', [AdminController::class, 'listJobs'])->name('admin.jobs'); // Show job listings
    Route::get('jobs/create', [AdminController::class, 'createJob'])->name('admin.create-job'); // Show create job form
    Route::post('jobs/store', [AdminController::class, 'storeJob'])->name('admin.store-job'); // Handle job creation
    Route::get('jobs/edit/{job}', [AdminController::class, 'editJob'])->name('admin.edit-job'); // Show edit job form
    Route::post('jobs/update/{job}', [AdminController::class, 'updateJob'])->name('admin.update-job'); // Handle job update
    Route::post('jobs/delete/{job}', [AdminController::class, 'deleteJob'])->name('admin.delete-job'); // Handle job deletion
});

Route::prefix('employer')->group(function () {
    Route::get('jobs', [EmployerController::class, 'listJobs'])->name('employer.jobs'); // Show employer's job listings
    Route::get('post-job', [EmployerController::class, 'createJob'])->name('employer.post-job'); // Show create job form
    Route::post('store-job', [EmployerController::class, 'storeJob'])->name('employer.store-job'); // Handle job creation
});

Route::prefix('jobseeker')->group(function () {
    Route::get('jobs', [JobSeekerController::class, 'listAvailableJobs'])->name('jobseeker.jobs'); // Show available jobs
    Route::get('apply-job/{job}', [JobSeekerController::class, 'showApplyJobForm'])->name('jobseeker.apply-job'); // Show job application form
    Route::post('apply-job/{job}', [JobSeekerController::class, 'applyForJob'])->name('jobseeker.submit-application'); // Handle job application
    Route::get('my-applications', [JobSeekerController::class, 'viewMyApplications'])->name('jobseeker.my-applications'); // Show user's applications
});
