<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 14/08/2018
 * Time: 11:40 PM
 */

namespace Hotel\Services\Facility;


use Hotel\Entities\Facility;
use Hotel\Entities\Media;
use Hotel\Repositories\FacilityRepository;
use Hotel\Repositories\MediaRepository;
use Hotel\Services\File\FileService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class DefaultFacilityService implements FacilityService {
	protected $facilityRepo;
	protected $fileService;
	protected $mediaRepo;

	public function __construct(FacilityRepository $facility_repository, FileService $file_service, MediaRepository $media_repository) {
		$this->facilityRepo = $facility_repository;
		$this->fileService = $file_service;
		$this->mediaRepo = $media_repository;
	}


	/**
	 * @param Request $request
	 *
	 * @return mixed | Collection | Model
	 * @throws \Exception
	 */
	function createFacility( Request $request ) {
		$body = $request->only('name', 'short_description', 'description', 'icon', 'image');
		$body['slug'] = str_slug($request->get('name'));
		return $this->facilityRepo->create($body);
	}

	/**
	 * @param $facilityId
	 * @param Request $request
	 *
	 * @return mixed | Model | Collection
	 * @throws \Exception
	 */
	function updateFacility( $facilityId, Request $request ) {
		$body = $request->only('name', 'short_description', 'description', 'icon', 'image');
		return $this->facilityRepo->update($body, $facilityId);
	}

	/**
	 * @param $facilityId
	 *
	 * @return mixed | Model | Collection
	 * @throws ModelNotFoundException
	 */
	function getFacilityById( $facilityId ) {
		return $this->facilityRepo->find($facilityId);
	}

	/**
	 * @return mixed | array | Collection
	 */
	function getAllFacilities() {
		return $this->facilityRepo->all();
	}

	/**
	 * @param $facilityId
	 *
	 * @return boolean
	 */
	function deleteFacilityById( $facilityId ) {
		return $this->facilityRepo->delete($facilityId);
	}

	/**
	 * @param array $files
	 * @param Model $model
	 *
	 * @return Media | Collection | null
	 */
	function addMedia( array $files, Model $model ) {
		if(!$model instanceof Facility){
			return null;
		}

		$uploadedMedia = [];
		foreach ($files AS $file){
			try {
				$savedFile = $this->fileService->saveFile( $file );
				$media = $this->mediaRepo->create($savedFile->toModelCreateArray());
				$model->media()->save($media);
				$uploadedMedia[] = $media;
			} catch ( FileException $e ) {

			}
		}
		return collect($uploadedMedia);
	}
}