<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailDetails;

    /**
     * Create a new message instance.
     */
    public function __construct($emailDetails)
    {
        $this->emailDetails = $emailDetails;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->emailDetails['subject'])
                    ->view('emails.custom')
                    ->with('details', $this->emailDetails);
    }
}
