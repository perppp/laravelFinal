<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobSeekerController extends Controller
{
    /**
     * List all public jobs available.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listPublicJobs()
    {
        return response()->json([
            [
                'title' => 'Sample Job 1',
                'description' => 'Job description goes here',
                'salary' => 50000,
            ],
            [
                'title' => 'Sample Job 2',
                'description' => 'Job description goes here',
                'salary' => 60000,
            ]
        ]);
    }

    /**
     * List all available jobs for job seekers (protected route).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listAvailableJobs()
    {
        $jobs = Job::all();

        return response()->json($jobs, 200);
    }

    /**
     * Apply for a job.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function applyForJob(Request $request)
    {
        $validated = $request->validate([
            'job_id' => 'required|integer|exists:jobs,id',
            'cover_letter' => 'required|string|max:1000',
        ]);

        $application = [
            'job_id' => $validated['job_id'],
            'cover_letter' => $validated['cover_letter'],
            'status' => 'Applied',
        ];

        return response()->json($application, 201);
    }
}
