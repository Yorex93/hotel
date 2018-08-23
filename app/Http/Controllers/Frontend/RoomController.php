<?php

namespace Hotel\Http\Controllers\Frontend;

use Hotel\Services\Hotel\HotelService;
use Hotel\Services\RoomType\RoomTypeService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

class RoomController extends Controller
{
	protected $roomTypeService;
	protected $hotelService;


	public function __construct(RoomTypeService $room_type_service, HotelService $hotel_service) {
		$this->hotelService = $hotel_service;
		$this->roomTypeService = $room_type_service;
	}

	public function index(){
		$pageTitle = 'Our Rooms';
		$roomTypes = $this->roomTypeService->getAll();
		$hotels = $this->hotelService->getHotels();
		return view('rooms.index', compact('hotels', 'roomTypes', 'pageTitle'));
	}


	public function show($slug){
		try {
			$hotels = $this->hotelService->getHotels();
			$roomType = $this->roomTypeService->getBySlug( $slug );
			$roomTypes = $this->roomTypeService->getAll();
			return view( 'rooms.show', compact( 'roomType', 'roomTypes', 'hotels' ) );
		} catch (ModelNotFoundException $e){
			return view( 'page.home' )->with('error', 'Room type not found');
		}
	}

	public function reserve($slug){
		return view('rooms.reserve');
	}
}
