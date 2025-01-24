<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application; // Assuming you have an Application model for job applications
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    /**
     * List all jobs posted by the employer.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listJobs()
    {
        $jobs = Job::where('user_id', auth()->id())->get();

        return response()->json($jobs, 200);
    }

    /**
     * Post a new job for employers.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postJob(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'salary' => 'required|numeric',
        ]);

        $job = Job::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'salary' => $validated['salary'],
            'user_id' => auth()->id(),
        ]);

        return response()->json($job, 201); // Created
    }

    /**
     * View all applications for posted jobs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function viewApplications()
    {
        $applications = Application::whereHas('job', function($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return response()->json($applications, 200);
    }
}
