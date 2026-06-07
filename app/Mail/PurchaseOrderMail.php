<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class PurchaseOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $pdfContent;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $pdfContent)
    {
        $this->data = $data;
        $this->pdfContent = $pdfContent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Purchase Order - PT Ecogreen Oleochemicals',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            htmlString: '<p>Yth. ' . htmlspecialchars($this->data['vendor']->nama_perusahaan) . ',</p>' .
                        '<p>Terlampir adalah dokumen Purchase Order (PO) dari PT Ecogreen Oleochemicals. Harap segera diproses sesuai pesanan.</p>' .
                        '<br><p>Terima kasih.</p>',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfContent, 'Purchase_Order.pdf')
                    ->withMime('application/pdf'),
        ];
    }
}
