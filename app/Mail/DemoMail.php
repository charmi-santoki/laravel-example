<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class DemoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData, $data;


    /**
     * Create a new message instance.
     */
    public function __construct($mailData, $data)
    {
        $this->mailData = $mailData;
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Demo Mail',
        );
    }

    /**
     * Get the message content def  inition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.demoMail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array

     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath(public_path('storage/' . $this->data)),
        ];
    }

    public function build()
    {
        return $this->view('emails.demoMail')
            ->with(['mailData' => $this->mailData]);
    }
}
