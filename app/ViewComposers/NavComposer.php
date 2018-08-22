<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 19/08/2018
 * Time: 2:17 PM
 */

namespace Hotel\ViewComposers;


use Hotel\Services\Facility\FacilityService;
use Hotel\Services\HotelServices\HotelServicesService;
use Illuminate\View\View;

class NavComposer {

	protected $hotelServices;
	protected $facilityService;

	public function __construct(HotelServicesService $hotel_services_service, FacilityService $facility_service) {
		$this->hotelServices = $hotel_services_service;
		$this->facilityService = $facility_service;
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		$view->with('navServices', $this->hotelServices->findAllForNav());
		$view->with('navFacilities', $this->facilityService->getAllFacilitiesForNav());
	}
}