<?php

namespace Hotel\Http\Controllers\Frontend;

use Hotel\Services\HotelServices\HotelServicesService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

class ServiceController extends Controller
{
	protected  $hotelServicesService;

	public function __construct(HotelServicesService $hotel_services_service) {
		$this->hotelServicesService = $hotel_services_service;
	}

	public function index(){
		return view('services.index');
	}


	public function show($slug){
		return view('services.show');
	}

	public function showHotelService($slug){
		try{
			$hotelService = $this->hotelServicesService->findBySlug($slug);
			$pageTitle = "Services | ".$hotelService->title;
			return view('services.hotel.show', compact('hotelService', 'pageTitle'));
		} catch (ModelNotFoundException $e){
			return redirect()->route('home');
		}


	}
}
