<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 11/08/2018
 * Time: 10:51 AM
 */

namespace Hotel\Services\Location;


use Hotel\Entities\Location;
use Hotel\Http\Requests\LocationCreateRequest;
use Hotel\Http\Requests\LocationUpdateRequest;
use Hotel\Repositories\ContactPersonRepository;
use Hotel\Repositories\CountryRepository;
use Hotel\Repositories\LocationRepository;
use Hotel\Repositories\StateRepository;
use Illuminate\Support\Collection;

class DefaultLocationService implements LocationService {

	protected $countryRepo;
	protected $stateRepo;
	protected $locationRepo;
	protected $contactPersonRepo;

	public function __construct(LocationRepository $location_repository,
		CountryRepository $country_repository, StateRepository $state_repository,
		ContactPersonRepository $contact_person_repository) {
		$this->countryRepo = $country_repository;
		$this->locationRepo = $location_repository;
		$this->stateRepo = $state_repository;
		$this->contactPersonRepo = $contact_person_repository;
	}

	/**
	 * @return mixed | Collection
	 */
	function getCountries() {
		return $this->countryRepo->all();
	}

	/**
	 * @param int $countryId
	 *
	 * @return mixed | Collection
	 */
	function getStatesByCountry( int $countryId ) {
		$country = $this->countryRepo->with('states')->find($countryId);
		if($country){
			return $country->states;
		}
		return [];
	}

	/**
	 * @return mixed | Collection
	 */
	public function getAllLocations() {
		// TODO: Implement getAllLocations() method.
	}

	/**
	 * @param LocationCreateRequest $request
	 *
	 * @return mixed | Location
	 */
	public function createLocation( LocationCreateRequest $request ) {
		$location = $this->locationRepo->create(
			$request->only('name', 'address', 'country_id', 'state_id', 'city', 'latitude', 'longitude', 'email', 'phone')
		);

		if($request->has('contact_person')){
			$c = $request->get('contact_person');
			$contactPerson = $this->contactPersonRepo->create([
				'title' => $c['title'],
				'last_name' => $c['last_name'],
				'first_name' => $c['first_name'],
				'middle_name' => $c['middle_name'],
				'email' => $c['email'],
				'phone_number' => $c['phone_number'],
				'location_id' => $location->id,
			]);
		}
		return $location;
	}

	/**
	 * @param LocationUpdateRequest $request
	 * @param $id
	 *
	 * @return mixed | Location
	 */
	public function updateLocation( LocationUpdateRequest $request, int $id ) {
		$location = $this->locationRepo->update(
			$request->only('name', 'address', 'country_id', 'state_id', 'city', 'latitude', 'longitude', 'email', 'phone'), $id
		);

		if($request->has('contact_person')){
			$c = $request->get('contact_person');
			$contactPerson = $this->contactPersonRepo->update([
				'title' => $c['title'],
				'last_name' => $c['last_name'],
				'first_name' => $c['first_name'],
				'middle_name' => $c['middle_name'],
				'email' => $c['email'],
				'phone_number' => $c['phone_number'],
			], $c['id']);
		}
		return $location;
	}

	/**
	 * @param $id
	 *
	 * @return boolean
	 */
	public function deleteLocation( int $id ) {
		// TODO: Implement deleteLocation() method.
		return true;
	}
}