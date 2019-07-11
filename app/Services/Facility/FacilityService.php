<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 14/08/2018
 * Time: 11:39 PM
 */

namespace Hotel\Services\Facility;


use Hotel\Entities\Facility;
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
	 * @return mixed | Model | Facility
	 * @throws ModelNotFoundException
	 */
	function getFacilityById($facilityId);

	/**
	 * @param $facilitySlug
	 *
	 * @return mixed | Model | Facility
	 * @throws ModelNotFoundException
	 */
	function getFacilityBySlug($facilitySlug);

	/**
	 * @param bool $withMedia
	 *
	 * @return mixed | array | Collection
	 */
	function getAllFacilities($withMedia = true);

	/**
	 * @param $facilityId
	 *
	 * @return boolean
	 */
	function deleteFacilityById($facilityId);


	function getAllFacilitiesForNav();


}