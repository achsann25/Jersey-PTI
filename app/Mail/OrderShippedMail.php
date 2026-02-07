<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShippedMail extends Mailable
{
    use Queueable, SerializesModels;

    // WAJIB: Deklarasikan variabel publik agar otomatis terlempar ke View Blade
    public $order;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        // Masukkan data order dari Controller ke variabel publik di atas
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Jersey Kamu Sedang Meluncur! 📦',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.shipped', // Pastikan filenya ada di resources/views/emails/shipped.blade.php
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}