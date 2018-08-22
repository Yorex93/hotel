<?php

namespace Hotel\Services\Hotel;

use Hotel\Entities\Location;
use Hotel\Http\Requests\HotelCreateRequest;
use Hotel\Http\Requests\HotelUpdateRequest;
use Hotel\Services\IncludesMedia;

interface HotelService extends IncludesMedia {

	/**
	 * @param bool $basic_details
	 *
	 * @return mixed | \Illuminate\Support\Collection
	 */
	function getHotels($basic_details = false);

	/**
	 * @param $hotelId
	 * @param HotelUpdateRequest $request
	 *
	 * @return \Hotel\Entities\Hotel
	 */
	function updateHotel(int $hotelId, HotelUpdateRequest $request);

	/**
	 * @param HotelCreateRequest $request
	 *
	 * @return \Hotel\Entities\Hotel
	 */
	function createHotel(HotelCreateRequest $request);


	/**
	 * @param int $hotelId
	 *
	 * @return boolean
	 */
	function deleteHotel(int $hotelId);

	/**
	 * @param int $hotelId
	 *
	 * @return \Hotel\Entities\Hotel | null
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	function getHotelById(int $hotelId);

	/**
	 * @param int $hotel_id
	 * @param Location $location
	 *
	 * @return mixed
	 */
	public function setLocation( int $hotel_id, Location $location );

}