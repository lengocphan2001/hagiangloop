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
        $contactName = isset($this->contactData['name']) ? (string) $this->contactData['name'] : '';
        $whatsapp = isset($this->contactData['whatsapp']) ? (string) $this->contactData['whatsapp'] : '';
        $email = isset($this->contactData['email']) ? (string) $this->contactData['email'] : '';
        $country = isset($this->contactData['country']) ? (string) $this->contactData['country'] : '';
        $contactMessage = isset($this->contactData['message']) ? (string) $this->contactData['message'] : '';
        
        return $this->subject(__('emails.contact_subject') . ' - ' . $contactName)
                    ->view('emails.contact', [
                        'contactName' => $contactName,
                        'whatsapp' => $whatsapp,
                        'email' => $email,
                        'country' => $country,
                        'contactMessage' => $contactMessage,
                    ]);
    }
}

