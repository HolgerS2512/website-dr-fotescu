<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(protected $values, protected $base64, protected $mail) {}

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('support' . substr($this->mail, strpos($this->mail, '@')), 'MAILINGSYSTEM'),
            subject: $this->values['reference'],
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mails.contact_mail',
            with: [
                'src' => $this->base64,
                'name' => ($this->values['gender'] ? $this->values['gender'] . ' ' : '') . $this->values['firstname'] .' '. $this->values['lastname'],
                'email' => $this->values['email'],
                'phone' => $this->values['phone'],
                'reference' => $this->values['reference'],
                'msg' => $this->values['msg'],
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
