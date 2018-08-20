<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 19/08/2018
 * Time: 10:54 AM
 */

namespace Hotel\Services\HotelServices;


use Hotel\Entities\HotelService;
use Hotel\Services\IncludesMedia;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface HotelServicesService extends IncludesMedia {

	/**
	 * @param Request $request
	 *
	 * @return mixed | HotelService
	 */
	public function create(Request $request);

	/**
	 * @param $serviceId
	 * @param Request $request
	 *
	 * @return mixed | HotelService
	 */
	public function update($serviceId, Request $request);

	/**
	 * @param $serviceId
	 *
	 * @return mixed | boolean
	 */
	public function delete($serviceId);

	/**
	 * @param $type
	 * @param $slug
	 *
	 * @return mixed | HotelService
	 */
	public function findByTypeSlug($type, $slug);

	/**
	 * @return mixed | Collection
	 */
	public function findAll();

	/**
	 * @return mixed | Collection
	 */
	public function findAllWithMedia();

	/**
	 * @param $id
	 *
	 * @return mixed | HotelService
	 */
	public function findById( $id );

	/**
	 * @param $slug
	 *
	 * @return mixed | HotelService
	 * @throws ModelNotFoundException
	 */
	public function findBySlug( $slug );


	/**
	 * @return mixed | Collection
	 */
	public function fetchParents();

	/**
	 * @return mixed | Collection
	 */
	public function findAllForNav();



}