<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostJobRequest;
use App\Http\Requests\UpdateApplicationStatusRequest;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employer');
    }

    public function postJob(PostJobRequest $request)
    {
        $validated = $request->validated();

        $job = Job::create($validated);
        return response()->json($job);
    }

    public function jobListings()
    {
        $jobs = Job::where('employer_id', auth()->id())->get();
        return response()->json($jobs);
    }

    public function manageApplications($jobId)
    {
        $applications = Application::where('job_id', $jobId)->get();
        return response()->json($applications);
    }

    public function updateApplicationStatus(UpdateApplicationStatusRequest $request, $applicationId)
    {
        $validated = $request->validated();

        $application = Application::findOrFail($applicationId);
        $application->status = $validated['status'];
        $application->save();

        return response()->json(['message' => 'Application status updated']);
    }
}
