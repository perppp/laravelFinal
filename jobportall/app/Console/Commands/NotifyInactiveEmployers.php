<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotifyInactiveEmployers extends Command
{
    protected $signature = 'notify:inactive-employers';
    protected $description = 'Notify employers who haven’t posted a job in the last 30 days';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $inactiveEmployers = User::where('role', 'employer')
            ->whereHas('jobs', function ($query) {
                $query->where('created_at', '<', now()->subDays(30));
            })->get();

        foreach ($inactiveEmployers as $employer) {
            Mail::to($employer->email)->send(new \App\Mail\InactiveEmployerNotification($employer));
        }

        $this->info('Inactive employers notified successfully.');
    }
}
