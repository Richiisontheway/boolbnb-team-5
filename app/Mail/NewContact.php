<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContact extends Mailable
{
    use Queueable, SerializesModels;

    // creo una nuova istanza di contact attraverso il Mailable richiamato nel ContactController
    public $contact;

    // Creo una nuova istanza del proprietario dell'appartamento
    // attraverso il Mailable richiamato nel ContactController
    public $ownerName;

    /**
     * Create a new message instance.
     */
    public function __construct($contact, $ownerName)
    {
        $this->contact = $contact;
        $this->ownerName = $ownerName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope( 
            replyTo: $this->contact->email,
            subject: 'New Contact',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content($this->view('emails.new-contact', [
    //         'ownerName' => $this->ownerName,
    //         'contact' => $this->contact,
    //     ]));
    // }
    
    public function content(): Content
    {
        return new Content(
            view: 'emails.new-contact',
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
