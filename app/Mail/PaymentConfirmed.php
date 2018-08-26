<?php

namespace Hotel\Mail;

use Hotel\Entities\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;

	/**
	 * Create a new message instance.
	 *
	 * @param Payment $payment
	 */
    public function __construct(Payment $payment)
    {
        $this->payment = Payment::with('booking.hotel.location', 'booking.booking_rooms.room_type')->find($payment->id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.payment')->from('reservations@hotelvaleriesuitesng.com')
                    ->subject('Payment Confirmation for Booking #'.$this->payment->booking->booking_ref)
	                ->to($this->payment->booking->email);
    }
}
