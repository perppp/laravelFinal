<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;

class JobSeekerController extends Controller
{
    public function listAvailableJobs()
    {
        $jobs = Job::all();
        return view('jobseeker.jobs', compact('jobs'));
    }

    public function showApplyJobForm(Job $job)
    {
        return view('jobseeker.apply-job', compact('job'));
    }

    public function applyForJob(Request $request, Job $job)
    {
        $request->validate([
            'cover_letter' => 'required|string',
        ]);

        Application::create([
            'job_id' => $job->id,
            'user_id' => auth()->user()->id,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',
        ]);

        return redirect()->route('jobseeker.jobs')->with('success', 'Application submitted successfully.');
    }

    public function viewMyApplications()
    {
        $applications = Application::where('user_id', auth()->user()->id)->get();
        return view('jobseeker.my-applications', compact('applications'));
    }
}
