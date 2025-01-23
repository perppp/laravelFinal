<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Job;
use App\Console\Commands\NotifyInactiveEmployers;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class NotifyInactiveEmployersTest extends TestCase
{
    public function test_notify_inactive_employers_sends_email()
    {
        Mail::fake();

        $employer = User::factory()->create([
            'role' => 'employer',
        ]);

        Job::factory()->create([
            'user_id' => $employer->id,
            'created_at' => now()->subDays(31),
        ]);

        $this->artisan('notify:inactive-employers')
             ->assertExitCode(0);

        Mail::assertSent(\App\Mail\InactiveEmployerNotification::class, function ($mail) use ($employer) {
            return $mail->hasTo($employer->email);
        });
    }
}
