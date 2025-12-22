<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentDetailsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $studentData;

    public function __construct(array $studentData)
    {
        $this->studentData = $studentData;
    }

    public function build()
    {
        return $this->subject('New Student Registration')
                    ->view('emails.student-details')
                    ->with('data', $this->studentData);
    }
}
