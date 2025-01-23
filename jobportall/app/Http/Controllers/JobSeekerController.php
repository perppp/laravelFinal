<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;

class JobSeekerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:job-seeker');
    }

    public function jobListings()
    {
        $jobs = Job::all();
        return response()->json($jobs);
    }

    public function applyForJob(Request $request, $jobId)
    {
        $application = Application::create([
            'job_id' => $jobId,
            'user_id' => auth()->id(),
            'cover_letter' => $request->cover_letter,
        ]);
        
        return response()->json(['message' => 'Applied successfully']);
    }

    public function applicationStatus()
    {
        $applications = Application::where('user_id', auth()->id())->get();
        return response()->json($applications);
    }
}