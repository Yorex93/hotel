<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 21/08/2018
 * Time: 9:09 PM
 */

namespace Hotel\Services\Booking;


use Hotel\Entities\Booking;
use Hotel\Repositories\BookingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DefaultBookingService implements BookingService {

	protected $bookingRepo;

	public function __construct(BookingRepository $booking_repository) {
		$this->bookingRepo = $booking_repository;
	}

	/**
	 * @param Request $request
	 *
	 * @return mixed | Booking
	 */
	function createBooking( Request $request ) {
		// TODO: Implement createBooking() method.
	}

	/**
	 * @param int $bookingId
	 * @param Request $request
	 *
	 * @return mixed | Booking
	 */
	function updateBooking( int $bookingId, Request $request ) {
		// TODO: Implement updateBooking() method.
	}

	/**
	 * @param Request $request
	 *
	 * @return mixed | Collection
	 */
	function getBookings( Request $request ) {
		// TODO: Implement getBookings() method.
	}

	/**
	 * @param $bookingId
	 *
	 * @return boolean
	 */
	function deleteBooking( $bookingId ) {
		return (bool) $this->bookingRepo->delete($bookingId);
	}
}