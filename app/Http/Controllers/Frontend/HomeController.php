<?php

namespace Hotel\Http\Controllers\Frontend;

use Hotel\Http\Controllers\Controller;
use Hotel\Repositories\PageItemRepository;
use Hotel\Repositories\PageRepository;
use Hotel\Services\Hotel\HotelService;
use Hotel\Services\RoomType\RoomTypeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	protected $roomTypeService;
	protected $hotelService;
	protected $pageRepo;


	public function __construct(RoomTypeService $room_type_service, HotelService $hotel_service, PageRepository $page_repository) {
		$this->roomTypeService = $room_type_service;
		$this->hotelService = $hotel_service;
		$this->pageRepo = $page_repository;
	}

	public function index(){

		$hotels = $this->hotelService->getHotels();
		$pageTitle = 'Luxury Hotel and Rooms for Business and Leisure in Asaba, Delta State';
		$page = $this->pageRepo->with('page_items')->findWhere(['for' => 'home']);
		$pageItems = [];
		if(count($page) > 0){
			$pageItems = $page[0]->page_items;
		}
		$roomTypes = $this->roomTypeService->getAll();
		return view('pages.home', compact('pageTitle', 'roomTypes', 'hotels', 'pageItems'));
	}


	public function contact(){
		return view('pages.contact');
	}

	public function about(){
		return view('pages.contact');
	}
}
