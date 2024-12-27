<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $treatment; 
    public $phone;
    public $messege;
    public $appointment_date;
    public $visited_before;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $phone, $treatment, $messege, $appointment_date, $visited_before)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->treatment = $treatment;
        $this->messege = $messege;
        $this->appointment_date = $appointment_date;
        $this->visited_before = $visited_before;
        

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.patient',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'treatment' => $this->treatment,
                'messege' => $this->messege,
                'appointment_date' => $this->appointment_date,
                'visited_before' => $this->visited_before,


            ]
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
