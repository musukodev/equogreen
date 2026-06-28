<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Procurement;

class AdminProfileUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $procurement;
    public $username;
    public $password;

    public function __construct(Procurement $procurement, $username, $password = null)
    {
        $this->procurement = $procurement;
        $this->username = $username;
        $this->password = $password;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pemberitahuan: Akun Procurement Anda Telah Diperbarui',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-profile-updated',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
