<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Rental;

class RentalConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
	
	public $rental;
    /**
     * Create a new message instance.
     */
    public function __construct(Rental $rental)
    {
        $this->rental = $rental;
		 $this->viewName = 'emails.rental_confirmation'; 
    }
	
	// public function build()
    // {
        // return $this->subject('Rental Confirmation')
                    // ->view('emails.rental_confirmation')
                    // ->with([
						// 'rental' => $this->rental,
                        // 'car_name' => $this->rental->car->name,
                        // 'rental_start_date' => $this->rental->start_date,
                        // 'rental_end_date' => $this->rental->end_date,
                        // 'total_cost' => $this->rental->total_cost,
                    // ]);
    // }
	 public function build()
    {
        return $this->view('emails.rental_confirmation') // Use the correct view
                    ->with([
                        'rental' => $this->rental, // Pass data to the view
                    ]);
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rental Confirmation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.rental_confirmation_markdown',  // Use markdown if applicable
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
