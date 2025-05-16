<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VoyageAnnule extends Mailable
{
    use Queueable, SerializesModels;

    public $utilisateur;

    public $voyage;

    /**
     * Create a new message instance.
     */
    public function __construct($utilisateur, $voyage)
    {
        $this->utilisateur = $utilisateur;
        $this->voyage = $voyage;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Voyage Annule',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.voyage_annule',
            with: [
                'utilisateur' => $this->utilisateur,
                'voyage' => $this->voyage,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
