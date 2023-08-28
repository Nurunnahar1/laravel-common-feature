<?php

namespace App\Mail;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class CategoryCreateMarkdown extends Mailable
{
    use Queueable, SerializesModels;
    public $category;

    /**
     * Create a new message instance.
     */
    public function __construct(Category $category)
    {
        $this->category=$category;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        return new Envelope(
            subject: 'Category Create Markdown',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $subject = "A New Category Created by this name {$this->category->name} ";
        // return $this->subject()->markdown('emails.category.created');
        return new Content(
            markdown: 'emails.category.created',
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
        // $subject = "A New Category Created by this name ";
        // return $this->subject()->markdown('emails.category.created');
    }
}
