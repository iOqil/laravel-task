<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class ApplicationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public Application $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('example@example.com', 'Example'),
            subject: 'Application Created',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application-created',
        );
    }
   
    public function attachments(): array
    {
        // Attach file only if a path is provided and the file exists
        if (!empty($this->application->file_url) && file_exists($this->application->file_url)) {
            return [
                Attachment::fromPath($this->application->file_url),
            ];
        }

        return [];
    }
}
