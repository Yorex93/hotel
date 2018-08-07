<?php

namespace Hotel\Services\Hotel;

use Hotel\Http\Requests\HotelCreateRequest;
use Hotel\Http\Requests\HotelUpdateRequest;
use Hotel\Repositories\HotelRepository;

class DefaultHotelService implements HotelService{

	protected $hotelRepository;

	protected $relations = ['location.contactPerson', 'parent', 'activities', 'activitySessions', 'socials', 'tags', 'reviews', 'facilities', 'media'];

	public function __construct(HotelRepository $hotel_repository) {
		$this->hotelRepository = $hotel_repository;
	}

	function getHotels() {
		return $this->hotelRepository->with($this->relations)->all();
	}

	function updateHotel(int $hotelId, HotelUpdateRequest $request ) {
		// TODO: Implement updateHotel() method.
	}

	function createHotel(HotelCreateRequest $request ) {
		// TODO: Implement createHotel() method.
	}

	function deleteHotel(int $hotelId ) {
		// TODO: Implement deleteHotel() method.
		return true;
	}

	function getHotelById( int $hotelId ) {
		// TODO: Implement getHotelById() method.
		return $this->hotelRepository->with($this->relations)->find($hotelId);
	}
}