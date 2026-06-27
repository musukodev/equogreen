<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Vendor;

class VendorQuotationApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $batch_id;
    public $pesan;

    public function __construct(Vendor $vendor, $batch_id, $pesan)
    {
        $this->vendor = $vendor;
        $this->batch_id = $batch_id;
        $this->pesan = $pesan;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Quotation Disetujui - Batch ' . $this->batch_id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.vendor-quotation-approved',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
