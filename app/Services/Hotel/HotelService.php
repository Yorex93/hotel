<?php

namespace Hotel\Services\Hotel;

use Hotel\Http\Requests\HotelCreateRequest;
use Hotel\Http\Requests\HotelUpdateRequest;

interface HotelService{

	/**
	 * @return mixed | \Illuminate\Support\Collection
	 */
	function getHotels();

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

}