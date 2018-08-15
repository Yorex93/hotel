<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 11/08/2018
 * Time: 9:07 PM
 */

namespace Hotel\Services\RoomType;


use Hotel\Entities\RoomType;
use Hotel\Http\Requests\RoomTypeCreateRequest;
use Hotel\Http\Requests\RoomTypeUpdateRequest;
use Hotel\Services\IncludesMedia;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

interface RoomTypeService extends IncludesMedia {
	/**
	 * @return mixed | Collection
	 */
	function getAll();

	/**
	 * @param RoomTypeCreateRequest $request
	 *
	 * @return mixed
	 */
	function create(RoomTypeCreateRequest $request);

	/**
	 * @param RoomTypeUpdateRequest $request
	 * @param int $roomTypeId
	 *
	 * @return mixed
	 */
	function update(RoomTypeUpdateRequest $request, int $roomTypeId);

	/**
	 * @param int $roomTypeId
	 *
	 * @return boolean
	 */
	function delete(int $roomTypeId);

	/**
	 * @param int $hotelId
	 *
	 * @return mixed | Collection
	 */
	function getByHotelId(int $hotelId);

	/**
	 * @param int $fromDate
	 * @param int|null $toDate
	 *
	 * @return mixed | Collection
	 */
	function getByAvailableDates(int $fromDate, int $toDate = null);

	/**
	 * @param int $hotelId
	 * @param int $fromDate
	 * @param int|null $toDate
	 *
	 * @return mixed
	 */
	function getByHotelIdAndAvailableDates(int $hotelId, int $fromDate, int $toDate = null);

	/**
	 * @param int|null $fromAmount
	 * @param int|null $toAmount
	 *
	 * @return mixed
	 */
	function getByPriceBetween(int $fromAmount = null, int $toAmount = null);

	/**
	 * @param $id
	 *
	 * @return mixed|RoomType
	 * @throws ModelNotFoundException
	 */
	public function getById( int $id );

	/**
	 * @param string $slug
	 *
	 * @return mixed|RoomType
	 * @throws ModelNotFoundException
	 */
	public function getBySlug(string $slug);

}