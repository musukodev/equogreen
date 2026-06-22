<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Vendor;

class VendorAnnouncementMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $isiPengumuman;

    public function __construct(Vendor $vendor, $isiPengumuman)
    {
        $this->vendor = $vendor;
        $this->isiPengumuman = $isiPengumuman;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengumuman Baru dari Procurement Equogreen',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.vendor-announcement',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
