<?php

namespace App\Mail;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class CategoryCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $category;

    /**
     * Create a new message instance.
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Category: {$this->category->name} Created",


            // $subject= "Category: {$this->category->name} Created",
            // return $this->subject($subject)->attach(public_path('invoices/invoice.pdf'),[
            //     'as'=>'order_invoice.pdf',
            //     'mime'=>'application/pdf',
            // ]);

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        return new Content(


            view:'emails.category.category-created',

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
