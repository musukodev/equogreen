<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Procurement;

class NewAdminWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $procurement;
    public $username;
    public $password;

    public function __construct(Procurement $procurement, $username, $password)
    {
        $this->procurement = $procurement;
        $this->username = $username;
        $this->password = $password;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Selamat Datang di Equogreen - Akun Procurement Anda Telah Dibuat',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-admin-welcome',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
