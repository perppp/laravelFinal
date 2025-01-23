<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;

class CheckExpiredJobs extends Command
{
    protected $signature = 'check:expired-jobs';
    protected $description = 'Notify employers about jobs nearing expiration';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $jobs = Job::where('expires_at', '<', now()->addDays(3))->get();

        foreach ($jobs as $job) {
            $employer = $job->employer;
            Mail::to($employer->email)->send(new \App\Mail\JobExpirationReminder($job));
        }

        $this->info('Expired jobs notification sent.');
    }
}
