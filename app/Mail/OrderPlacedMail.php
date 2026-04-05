<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Commande $commande)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Confirmation de commande '.$this->commande->numero_commande);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.order-placed');
    }
}
