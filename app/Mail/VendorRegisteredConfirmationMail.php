<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Vendor;

class VendorRegisteredConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;

    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pendaftaran Akun Vendor Equogreen Berhasil',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.vendor-registered-confirmation',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
