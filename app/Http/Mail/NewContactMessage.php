<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public Message $contactMessage;

    public function __construct(Message $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    public function build(): static
    {
        return $this
            ->subject('Ново съобщение от контактната форма: ' . $this->contactMessage->name)
            ->view('emails.new_contact_message');
    }
}
