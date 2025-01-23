<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;

class InactiveEmployerNotification extends Mailable
{
    public $employer;

    public function __construct(User $employer)
    {
        $this->employer = $employer;
    }

    public function build()
    {
        return $this->subject('We miss you!')->view('emails.inactive-employer');
    }
}
