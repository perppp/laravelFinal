<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::get('users', [AdminController::class, 'listUsers']);
    Route::post('create-user', [AdminController::class, 'createUser']);
});

Route::prefix('employer')->middleware('auth:sanctum')->group(function () {
    Route::get('jobs', [EmployerController::class, 'listJobs']);
    Route::post('post-job', [EmployerController::class, 'postJob']);
    Route::get('applications', [EmployerController::class, 'viewApplications']);
});

Route::prefix('job-seeker')->middleware('auth:sanctum')->group(function () {
    Route::get('jobs', [JobSeekerController::class, 'listAvailableJobs']);
    Route::post('apply-job', [JobSeekerController::class, 'applyForJob']);
});

Route::get('public-jobs', [JobSeekerController::class, 'listPublicJobs']);
