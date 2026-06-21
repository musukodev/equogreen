<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Vendor;

class VendorReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $batch_id;

    public function __construct(Vendor $vendor, $batch_id)
    {
        $this->vendor = $vendor;
        $this->batch_id = $batch_id;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reminder: Submit Quotation for Batch ' . $this->batch_id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.vendor-reminder',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
