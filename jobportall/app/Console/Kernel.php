<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\NotifyInactiveEmployers::class,
        \App\Console\Commands\SendApplicationSummary::class,
        \App\Console\Commands\CheckExpiredJobs::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notify:inactive-employers')->monthly();
        $schedule->command('send:application-summary')->weeklyOn(7, '20:00');
        $schedule->command('check:expired-jobs')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
