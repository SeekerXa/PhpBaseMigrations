<?php

namespace App\Mail;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertMail extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct(protected Weather $weather,protected City $city)
    {
        $this->weather = $weather;
        $this->city = $city;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
          return new Envelope(
            from: new Address(config('mail.from.address'), 'Pati'),
            subject: 'Weather alert',
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
            view: 'emails.weathers.alert',
            with: [
                'weather' => $this->weather,
                'city'=>$this->city
            ]
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
