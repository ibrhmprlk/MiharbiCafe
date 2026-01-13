<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    // Bunlar public olduğu için Blade bunlara direkt erişir
    public $name;
    public $email;
    public $userMessage;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->userMessage = $data['message'];
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Yeni İletişim Mesajı',
        );
    }

public function content(): Content
{
    return new Content(
        view: 'emails.contact',
        with: [
            'name' => $this->name,
            'email' => $this->email,
            'userMessage' => $this->userMessage,
        ],
    );
}


    public function attachments(): array
    {
        return [];
    }
}


