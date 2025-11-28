<?php

namespace App\Mail;

use App\Models\Product;
use App\Models\ProductGuestReview;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewReviewNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public ProductGuestReview $review;
    public Product $product;

    /**
     * Create a new message instance.
     */
    public function __construct(ProductGuestReview $review, Product $product)
    {
        $this->review = $review;
        $this->product = $product;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ulasan Baru untuk Produk Anda - ' . $this->product->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.review.notification',
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
