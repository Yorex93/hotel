<?php

namespace Hotel\Http\Controllers\Frontend;

use Hotel\Services\Facility\FacilityService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Hotel\Http\Controllers\Controller;

class FacilityController extends Controller
{
	protected $facilityService;

	public function __construct(FacilityService $facility_service) {
		$this->facilityService = $facility_service;
	}

	public function index(){
		$facilities = $this->facilityService->getAllFacilities();
		return view('facilities.index', compact('facilities'));
	}


	public function show($slug){
		try{
			$facility = $this->facilityService->getFacilityBySlug($slug);
			$pageTitle = ' Facilities | '.$facility->name;
			return view('facilities.show', compact('facility', 'pageTitle'));
		} catch (ModelNotFoundException $e){
			return redirect()->route('home');
		}
	}
}
