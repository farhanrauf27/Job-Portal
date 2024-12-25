<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobPostedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $job;

    public function __construct($job)
    {
        $this->job = $job;
    }

    public function build()
    {
        return $this->view('emails.job_posted')
                    ->subject('New Job Posted: ' . $this->job->title)
                    ->with('job', $this->job);
    }
}