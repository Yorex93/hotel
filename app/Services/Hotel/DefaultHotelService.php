<?php

namespace Hotel\Services\Hotel;

use Defuse\Crypto\Exception\IOException;
use Hotel\Entities\Hotel;
use Hotel\Entities\Location;
use Hotel\Entities\Media;
use Hotel\Http\Requests\HotelCreateRequest;
use Hotel\Http\Requests\HotelUpdateRequest;
use Hotel\Repositories\HotelRepository;
use Hotel\Repositories\MediaRepository;
use Hotel\Services\File\FileService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class DefaultHotelService implements HotelService{

	protected $hotelRepository;
	protected $fileService;
	protected $mediaRepo;

	protected $relations = ['location.contactPerson', 'parent', 'activities', 'roomTypes', 'rooms', 'activitySessions', 'socials', 'tags', 'reviews', 'facilities', 'media'];

	public function __construct(HotelRepository $hotel_repository, FileService $file_service, MediaRepository $media_repository) {
		$this->hotelRepository = $hotel_repository;
		$this->fileService = $file_service;
		$this->mediaRepo = $media_repository;
	}

	function getHotels() {
		return $this->hotelRepository->with($this->relations)->all();
	}

	function updateHotel(int $hotelId, HotelUpdateRequest $request ) {
		$hotel = $this->hotelRepository->update([
			'name' => $request->get('name'),
			'slug' => str_slug($request->get('name')),
			'description' => $request->get('description'),
			'sub_title' => $request->get('sub_title'),
			'email' => $request->get('email'),
			'phone' => $request->get('phone'),
			'website' => $request->get('website'),
			'parent_hotel_id' => $request->get('parent_hotel_id')
		], $hotelId);
		return $hotel;
	}

	function createHotel(HotelCreateRequest $request ) {
		$hotel = $this->hotelRepository->create([
			'name' => $request->get('name'),
			'slug' => str_slug($request->get('name')),
			'description' => $request->get('description'),
			'sub_title' => $request->get('sub_title'),
			'email' => $request->get('email'),
			'phone' => $request->get('phone'),
			'website' => $request->get('website'),
			'parent_hotel_id' => $request->get('parent_hotel_id')
		]);
		return $hotel;
	}

	function deleteHotel(int $hotelId ) {
		// TODO: Implement deleteHotel() method.
		return true;
	}

	/**
	 * @param int $hotelId
	 *
	 * @return Hotel|mixed|null
	 * @throws ModelNotFoundException
	 */
	function getHotelById( int $hotelId ) {
		// TODO: Implement getHotelById() method.
		return $this->hotelRepository->with($this->relations)->find($hotelId);
	}

	/**
	 * @param int $hotel_id
	 * @param Location $location
	 *
	 * @return mixed
	 */
	public function setLocation( int $hotel_id, Location $location ) {
		$hotel =  $this->hotelRepository->find($hotel_id);
		$hotel->location_id = $location->id;
		$hotel->save();
		return $hotel;
	}

	/**
	 * @param mixed $files
	 * @param Model $model
	 *
	 * @return mixed | Collection
	 */
	function addMedia( array $files, Model $model ) {
		if(!$model instanceof Hotel){
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
}