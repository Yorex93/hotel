<?php

namespace Hotel\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $mailRequest;

	/**
	 * Create a new message instance.
	 *
	 * @param Request $request
	 */
    public function __construct(Request $request)
    {
        $this->mailRequest = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.contact')
                    ->from('contact@hotelvaleriesuitesng.com')
                    ->replyTo($this->mailRequest->get('email'))
                    ->subject('New Contact mail for Hotel Valerie');
    }
}
