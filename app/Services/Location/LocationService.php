<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 11/08/2018
 * Time: 10:50 AM
 */

namespace Hotel\Services\Location;


use Hotel\Entities\Location;
use Hotel\Http\Requests\LocationCreateRequest;
use Hotel\Http\Requests\LocationUpdateRequest;
use Illuminate\Support\Collection;

interface LocationService {

	/**
	 * @return mixed | Collection
	 */
	function getCountries();

	/**
	 * @param int $countryId
	 *
	 * @return mixed | Collection
	 */
	function getStatesByCountry(int $countryId);


	/**
	 * @return mixed | Collection
	 */
	public function getAllLocations();

	/**
	 * @param LocationCreateRequest $request
	 *
	 * @return mixed | Location
	 */
	public function createLocation( LocationCreateRequest $request );


	/**
	 * @param LocationUpdateRequest $request
	 * @param $id
	 *
	 * @return mixed | Location
	 */
	public function updateLocation( LocationUpdateRequest $request, int $id );

	/**
	 * @param $id
	 *
	 * @return boolean
	 */
	public function deleteLocation( int $id );

}