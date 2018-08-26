<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 21/08/2018
 * Time: 9:09 PM
 */

namespace Hotel\Services\Booking;


use Hotel\Entities\Booking;
use Hotel\Entities\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface BookingService {

	/**
	 * @param Request $request
	 *
	 * @return mixed | Booking
	 */
	function createBooking(Request $request);

	/**
	 * @param int $bookingId
	 * @param Request $request
	 *
	 * @return mixed | Booking
	 */
	function updateBooking(int $bookingId, Request $request);

	/**
	 * @param Request $request
	 *
	 * @return mixed | Collection
	 */
	function getBookings(Request $request);

	/**
	 * @param $bookingId
	 *
	 * @return boolean
	 */
	function deleteBooking($bookingId);

	/**
	 * @param string $reference
	 *
	 * @return mixed | Payment
	 * @throws \Exception
	 */
	public function checkPayment( string $reference );


}