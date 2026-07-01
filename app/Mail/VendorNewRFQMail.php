<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Vendor;

class VendorNewRFQMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $batch_id;
    public $items;

    public function __construct(Vendor $vendor, $batch_id, array $items)
    {
        $this->vendor = $vendor;
        $this->batch_id = $batch_id;
        $this->items = $items;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permintaan Penawaran Harga Baru (RFQ) - Batch ' . $this->batch_id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.vendor-new-rfq',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
