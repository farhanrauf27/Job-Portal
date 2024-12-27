<?php

namespace App\Jobs;

use App\Mail\JobPostedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable; // Add this
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;  // Ensure Dispatchable is included here

    public $user;
    public $job;

    // Constructor to pass user and job data
    public function __construct($user, $job)
    {
        $this->user = $user;
        $this->job = $job;
    }

    // Handle method to send email
    public function handle()
    {
        // Send the email to the user using the JobPostedNotification mail
        Mail::to($this->user->email)
            ->send(new JobPostedNotification($this->job, $this->user));
    }
}
