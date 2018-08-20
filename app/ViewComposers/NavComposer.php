<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 19/08/2018
 * Time: 2:17 PM
 */

namespace Hotel\ViewComposers;


use Hotel\Services\HotelServices\HotelServicesService;
use Illuminate\View\View;

class NavComposer {

	protected $hotelServices;

	public function __construct(HotelServicesService $hotel_services_service) {
		$this->hotelServices = $hotel_services_service;
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
	}
}