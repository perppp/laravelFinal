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
        // Query the database for public jobs
        $jobs = Job::where('is_public', true)->get(); // Assuming there's an 'is_public' column for public jobs

        return response()->json($jobs, 200);
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
