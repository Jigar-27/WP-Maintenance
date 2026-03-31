<?php

namespace App\Mail;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionReminder extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Subscription $subscription,
        public int $daysRemaining
    ) {
    }

    public function envelope(): Envelope
    {
        $subject = $this->daysRemaining > 0
            ? "Your subscription expires in {$this->daysRemaining} days"
            : "Your subscription has expired today";

        return new Envelope(subject: $subject . ' — WP Maintenance');
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.subscription-reminder',
        );
    }
}
