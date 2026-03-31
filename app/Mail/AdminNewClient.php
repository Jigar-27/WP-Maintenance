<?php

namespace App\Mail;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNewClient extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Subscription $subscription)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉 New Client Subscription — ' . $this->subscription->client->full_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-new-client',
        );
    }
}
