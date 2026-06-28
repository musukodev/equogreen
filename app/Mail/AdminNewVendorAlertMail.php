<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Vendor;

class AdminNewVendorAlertMail extends Mailable
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
            subject: 'Pemberitahuan: Pendaftaran Vendor Baru - ' . $this->vendor->nama_perusahaan,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-new-vendor-alert',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
