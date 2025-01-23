<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employer');
    }

    public function postJob(Request $request)
    {
        $job = Job::create($request->all());
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

    public function updateApplicationStatus($applicationId, $status)
    {
        $application = Application::findOrFail($applicationId);
        $application->status = $status;
        $application->save();

        return response()->json(['message' => 'Application status updated']);
    }
}