<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;

    /**
     * Create a new message instance.
     */
    public function __construct(array $contactData)
    {
        $this->contactData = $contactData;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Contact Form Submission - ' . ($this->contactData['name'] ?? 'Unknown'))
                    ->view('emails.contact')
                    ->with([
                        'contactName' => (string) ($this->contactData['name'] ?? ''),
                        'whatsapp' => (string) ($this->contactData['whatsapp'] ?? ''),
                        'email' => (string) ($this->contactData['email'] ?? ''),
                        'country' => (string) ($this->contactData['country'] ?? ''),
                        'contactMessage' => (string) ($this->contactData['message'] ?? ''),
                    ]);
    }
}

