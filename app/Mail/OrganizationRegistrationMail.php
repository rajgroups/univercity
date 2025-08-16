<?php

namespace App\Mail;

use App\Models\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrganizationRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $organization;

    public function __construct(Organization $organization)
    {
        $this->organization = $organization;
    }

    public function build()
    {
        return $this->subject('New Organization Registration')
                    ->view('emails.organization_registration');
    }
}
