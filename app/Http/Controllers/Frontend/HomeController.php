<?php

namespace Hotel\Http\Controllers\Frontend;

use Hotel\Http\Controllers\Controller;
use Hotel\Mail\Contact;
use Hotel\Repositories\PageRepository;
use Hotel\Services\Hotel\HotelService;
use Hotel\Services\RoomType\RoomTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
		$pageTitle = 'Luxury Hotel | The Ideal Home';
		$page = $this->pageRepo->with('page_items')->findWhere(['for' => 'home']);
		$pageItems = [];
		if(count($page) > 0){
			$pageItems = $page[0]->page_items;
		}
		$roomTypes = $this->roomTypeService->getAll();
		return view('pages.home', compact('pageTitle', 'roomTypes', 'hotels', 'pageItems'));
	}


	public function contact(){
		$pageTitle = 'Contact';
		$hotels = $this->hotelService->getHotels(true);
		$page = $this->pageRepo->with('page_items')->findWhere(['for' => 'contact']);
		$pageItems = [];
		if(count($page) > 0){
			$pageItems = $page[0]->page_items;
		}

		return view('pages.contact', compact('pageTitle', 'hotels', 'pageItems'));
	}

	public function contactSubmit(Request $request){
		$this->validate($request, [
			'name' => 'required',
			'phone' => 'required',
			'email' => 'required | email',
			'message' => 'required'
		]);

		try{
			Mail::to('yorex4real@gmail.com')
			    ->send(new Contact($request));
			$request->session()->flash('success', true);
		} catch (\Throwable $e){
			$request->session()->flash('failed', 'Sorry, an error occurred while sending mail');
		}

		return redirect()->back();
	}

	public function about(){
		$pageTitle= 'About Us';
		$hotels = $this->hotelService->getHotels();
		$page = $this->pageRepo->with('page_items')->findWhere(['for' => 'about']);
		$pageItems = [];
		if(count($page) > 0){
			$pageItems = $page[0]->page_items;
		}

		return view('pages.about.index', compact('pageItems', 'pageTitle', 'hotels'));
	}
}
