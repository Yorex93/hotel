<?php

namespace Hotel\Http\Controllers\Frontend;

use Hotel\Http\Controllers\Controller;
use Hotel\Services\RoomType\RoomTypeService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
	protected $roomTypeService;

	public function __construct(RoomTypeService $room_type_service) {
		$this->roomTypeService = $room_type_service;
	}

	public function index(Request $request){
		$available = $this->roomTypeService->checkAvailability($request);
		return view('reservations.index');
	}


	public function check(Request $request){
		return view('reservations.check');
	}
}
