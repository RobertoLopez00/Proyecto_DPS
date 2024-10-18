<?php

namespace App\Mail;

use App\Models\venta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class transferencia extends Mailable
{
    use Queueable, SerializesModels;

    public $orden;
    /**
     * Create a new message instance.
     */
    public function __construct($orden)
    {
        $this->orden = $orden;
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Transferencia',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $venta = venta::find($this->orden);
        return new Content(
            view: 'emails.transferencia',
            with: ['venta' => $venta ]
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
