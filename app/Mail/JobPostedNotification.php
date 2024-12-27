<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Job;

class JobPostedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $job;
    public $user;

    public function __construct(Job $job, $user)
    {
        $this->job = $job;
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.jobPosted')  // Correct path to the view
            ->with([
                'job' => $this->job,
                'user' => $this->user,
            ])
            ->subject('New Job Posted: ' . $this->job->job_title);
    }
    

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Job in the System',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.jobPosted',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
