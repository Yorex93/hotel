<?php

namespace Hotel\Http\Controllers\Frontend;

use Hotel\Http\Controllers\Controller;
use Hotel\Services\Booking\BookingService;
use Hotel\Services\RoomType\RoomTypeService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
	protected $roomTypeService;
	protected $booking_service;

	public function __construct(RoomTypeService $room_type_service, BookingService $booking_service) {
		$this->roomTypeService = $room_type_service;
		$this->booking_service = $booking_service;
	}

	public function index(Request $request){
		return view('reservations.index');
	}


	public function check(Request $request){

		return view('reservations.check');
	}


}
