<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Vendor;
use App\Models\Batch;

class AdminQuotationSubmittedAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $batch;

    public function __construct(Vendor $vendor, Batch $batch)
    {
        $this->vendor = $vendor;
        $this->batch = $batch;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pemberitahuan: Vendor ' . $this->vendor->nama_perusahaan . ' Mengirimkan Quotation',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-quotation-submitted-alert',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
