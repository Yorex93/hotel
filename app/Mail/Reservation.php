<?php

namespace Hotel\Mail;

use Hotel\Entities\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reservation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

	/**
	 * Create a new message instance.
	 *
	 * @param Booking $booking
	 */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.reservation')
                    ->from('reservations@hotelvaleriesuitesng.com')
                    ->subject('Your Reservation at Hotel Valerie');
    }
}
