<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewDetailsEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $interviewDetails;

    /**
     * Create a new message instance.
     *
     * @param $interviewDetails
     */
    public function __construct($interviewDetails)
    {
        $this->interviewDetails = $interviewDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.interview_details')
                    ->subject('Interview Invitation')
                    ->with('details', $this->interviewDetails);
    }
}
