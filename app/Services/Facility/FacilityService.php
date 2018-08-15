<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 14/08/2018
 * Time: 11:39 PM
 */

namespace Hotel\Services\Facility;


use Hotel\Services\IncludesMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface FacilityService extends IncludesMedia {

	/**
	 * @param Request $request
	 *
	 * @return mixed | Collection | Model
	 */
	function createFacility(Request $request);

	/**
	 * @param $facilityId
	 * @param Request $request
	 *
	 * @return mixed | Model | Collection
	 * @throws \Exception
	 */
	function updateFacility($facilityId, Request $request);

	/**
	 * @param $facilityId
	 *
	 * @return mixed | Model | Collection
	 * @throws ModelNotFoundException
	 */
	function getFacilityById($facilityId);

	/**
	 * @return mixed | array | Collection
	 */
	function getAllFacilities();

	/**
	 * @param $facilityId
	 *
	 * @return boolean
	 */
	function deleteFacilityById($facilityId);

}