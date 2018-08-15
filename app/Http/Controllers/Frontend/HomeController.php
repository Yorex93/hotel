<?php

namespace Hotel\Http\Controllers\Frontend;

use Hotel\Http\Controllers\Controller;
use Hotel\Services\Hotel\HotelService;
use Hotel\Services\RoomType\RoomTypeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	protected $roomTypeService;
	protected $hotelService;


	public function __construct(RoomTypeService $room_type_service, HotelService $hotel_service) {
		$this->roomTypeService = $room_type_service;
		$this->hotelService = $hotel_service;
	}

	public function index(){

		$hotels = $this->hotelService->getHotels();
		$pageTitle = 'Luxury Hotel and Rooms for Business and Leisure in Asaba, Delta State';
		$roomTypes = $this->roomTypeService->getAll();
		return view('pages.home', compact('pageTitle', 'roomTypes', 'hotels'));
	}


	public function contact(){
		return view('pages.contact');
	}

	public function about(){
		return view('pages.contact');
	}
}
