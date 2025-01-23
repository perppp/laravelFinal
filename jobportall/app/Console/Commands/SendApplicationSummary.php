<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Mail;

class SendApplicationSummary extends Command
{
    protected $signature = 'send:application-summary';
    protected $description = 'Send a weekly summary of applications to employers';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $applications = Application::where('created_at', '>=', now()->subWeek())->get();

        $groupedByEmployer = $applications->groupBy('job.employer_id');

        foreach ($groupedByEmployer as $employerId => $apps) {
            $employer = User::find($employerId);

            Mail::to($employer->email)->send(new \App\Mail\ApplicationSummary($apps));
        }

        $this->info('Application summary sent to employers.');
    }
}
