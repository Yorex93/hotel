<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 19/08/2018
 * Time: 10:54 AM
 */

namespace Hotel\Services\HotelServices;


use Hotel\Entities\HotelService;
use Hotel\Entities\Media;
use Hotel\Repositories\HotelServiceRepository;
use Hotel\Repositories\MediaRepository;
use Hotel\Services\File\FileService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class DefaultHotelServicesService implements HotelServicesService {

	protected $hotelServicesRepo;
	protected $fileService;
	protected $mediaRepo;

	public function __construct(HotelServiceRepository $hotel_service_repository, FileService $file_service, MediaRepository $media_repository) {
		$this->hotelServicesRepo = $hotel_service_repository;
		$this->mediaRepo = $media_repository;
		$this->fileService = $file_service;
	}

	/**
	 * @param array $files
	 * @param Model $model
	 *
	 * @return Media | Collection | null
	 */
	function addMedia( array $files, Model $model ) {
		if(!$model instanceof HotelService){
			return null;
		}
		$uploadedMedia = [];
		foreach ($files AS $file){
			try {
				$savedFle = $this->fileService->saveFile( $file );
				$media = $this->mediaRepo->create($savedFle->toModelCreateArray());
				$model->media()->save($media);
				$uploadedMedia[] = $media;
			} catch ( FileException $e ) {

			}
		}
		return collect($uploadedMedia);
	}

	/**
	 * @param Request $request
	 *
	 * @return mixed | HotelService
	 */
	public function create( Request $request ) {
		$body = $request->only(['title', 'parent', 'short_description', 'long_description']);
		$body['slug'] = str_slug($request->get('title'));
		$service = $this->hotelServicesRepo->create($body);
		return $service;
	}

	/**
	 * @param $serviceId
	 * @param Request $request
	 *
	 * @return mixed | HotelService
	 */
	public function update( $serviceId, Request $request ) {
		$service = $this->hotelServicesRepo->update($request->only(['title', 'parent', 'short_description', 'long_description']), $serviceId);
		return $service;
	}

	/**
	 * @param $serviceId
	 *
	 * @return mixed | boolean
	 */
	public function delete( $serviceId ) {
		return (bool) $this->hotelServicesRepo->delete($serviceId);
	}

	/**
	 * @param $type
	 * @param $slug
	 *
	 * @return mixed | HotelService
	 */
	public function findByTypeSlug( $type, $slug ) {
		return $this->hotelServicesRepo->with(['media', 'children.media'])->findWhere(
			['category' => strtoupper($type), 'slug' => $slug]
		);
	}

	/**
	 * @return mixed | Collection
	 */
	public function findAll() {
		return $this->hotelServicesRepo->with(['media', 'parent_service'])->findWhere([['parent', '!=', 'NULL']]);
	}

	/**
	 * @return mixed | Collection
	 */
	public function findAllForNav() {
		return $this->hotelServicesRepo->with(['children.media'])->findWhere([['parent', '=', NULL]]);
	}

	/**
	 * @return mixed | Collection
	 */
	public function findAllWithMedia() {
		return $this->hotelServicesRepo->with(['media', 'parent_service'])->findWhere([['parent', '!=', 'NULL']]);
	}

	/**
	 * @param $id
	 *
	 * @return mixed | HotelService
	 */
	public function findById( $id ) {
		return $this->hotelServicesRepo->find($id);
	}


	public function fetchParents(){
		return $this->hotelServicesRepo->findWhere([['parent', '=', NULL]]);
	}

	/**
	 * @param $slug
	 *
	 * @return mixed | HotelService
	 * @throws ModelNotFoundException
	 */
	public function findBySlug( $slug ) {
		$services = $this->hotelServicesRepo->with(['media', 'children.media'])->findWhere([['slug', '=', $slug]]);
		if(count($services) > 0){
			return $services[0];
		} else {
			throw new ModelNotFoundException("Hotel Service Not Found");
		}
	}
}