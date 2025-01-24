<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function listJobs()
    {
        $jobs = Job::all();
        return view('admin.jobs', compact('jobs'));
    }

    public function createJob()
    {
        return view('admin.create-job');
    }

    public function storeJob(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|integer',
        ]);

        Job::create($request->all());

        return redirect()->route('admin.jobs')->with('success', 'Job created successfully!');
    }

    public function editJob(Job $job)
    {
        return view('admin.edit-job', compact('job')); // Pass the job to the edit view
    }

    public function updateJob(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|integer',
        ]);

        $job->update($request->all()); // Update the job with new data

        return redirect()->route('admin.jobs')->with('success', 'Job updated successfully!');
    }

    public function deleteJob(Job $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs')->with('success', 'Job deleted successfully!');
    }
}
