<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VendorApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $temporaryPassword;

    public function __construct($vendor, $temporaryPassword)
    {
        $this->vendor = $vendor;
        $this->temporaryPassword = $temporaryPassword;
    }

    public function build()
    {
        return $this->view('emails.vendor-approved')
                    ->with([
                        'vendor' => $this->vendor,
                        'temporaryPassword' => $this->temporaryPassword,
                    ]);
    }
}