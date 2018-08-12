<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 11/08/2018
 * Time: 9:08 PM
 */

namespace Hotel\Services\RoomType;


use Defuse\Crypto\Exception\IOException;
use Hotel\Entities\Media;
use Hotel\Entities\Room;
use Hotel\Entities\RoomType;
use Hotel\Http\Requests\RoomTypeCreateRequest;
use Hotel\Http\Requests\RoomTypeUpdateRequest;
use Hotel\Repositories\MediaRepository;
use Hotel\Repositories\RoomTypeRepository;
use Hotel\Services\File\FileService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class DefaultRoomTypeService implements RoomTypeService {

	protected $roomTypeRepo;
	protected $fileService;
	protected $mediaRepo;

	protected $relations = ['media'];


	public function __construct(RoomTypeRepository $room_type_repository,
		FileService $file_service,
		MediaRepository $media_repository) {

		$this->roomTypeRepo = $room_type_repository;
		$this->fileService = $file_service;
		$this->mediaRepo = $media_repository;

	}

	/**
	 * @return mixed | Collection
	 */
	function getAll() {
		return $this->roomTypeRepo->with($this->relations)->all();
	}

	/**
	 * @param RoomTypeCreateRequest $request
	 *
	 * @return mixed
	 */
	function create( RoomTypeCreateRequest $request ) {
		$body = $request->only('hotel_id', 'title', 'sub_title',
			'max_children', 'max_adults', 'max_people', 'description', 'maintenance_start', 'maintenance_end');

		$body['slug'] = str_slug($request->get('title'));
		if($request->has('is_homepage')){
			$body['is_homepage'] = $request->get('is_homepage');
		}
		return $this->roomTypeRepo->create($body);
	}

	/**
	 * @param RoomTypeUpdateRequest $request
	 * @param int $roomTypeId
	 *
	 * @return mixed
	 */
	function update( RoomTypeUpdateRequest $request, int $roomTypeId ) {
		$body = $request->only('hotel_id', 'title', 'sub_title',
			'max_children', 'max_adults', 'max_people', 'description', 'maintenance_start', 'maintenance_end');

		if($request->has('is_homepage')){
			$body['is_homepage'] = $request->get('is_homepage');
		}
		return $this->roomTypeRepo->update( $body, $roomTypeId);
	}

	/**
	 * @param int $roomTypeId
	 *
	 * @return boolean
	 */
	function delete( int $roomTypeId ) {
		// TODO: Implement delete() method.
	}

	/**
	 * @param int $hotelId
	 *
	 * @return mixed | Collection
	 */
	function getByHotelId( int $hotelId ) {
		return $this->roomTypeRepo->with($this->relations)->findWhere([ 'hotel_id' => $hotelId]);
	}

	/**
	 * @param int $fromDate
	 * @param int|null $toDate
	 *
	 * @return mixed | Collection
	 */
	function getByAvailableDates( int $fromDate, int $toDate = null ) {
		// TODO: Implement getByAvailableDates() method.
	}

	/**
	 * @param int $hotelId
	 * @param int $fromDate
	 * @param int|null $toDate
	 *
	 * @return mixed
	 */
	function getByHotelIdAndAvailableDates( int $hotelId, int $fromDate, int $toDate = null ) {
		// TODO: Implement getByHotelIdAndAvailableDates() method.
	}

	/**
	 * @param int|null $fromAmount
	 * @param int|null $toAmount
	 *
	 * @return mixed
	 */
	function getByPriceBetween( int $fromAmount = null, int $toAmount = null ) {
		$roomTypes = $this->roomTypeRepo->with($this->relations);
		$query = [['id', '>', '0']];
		if($fromAmount){
			$query[] = [[ 'base_price_per_night' , '>', $fromAmount ]];
		}
		if($toAmount){
			$query[] = [[ 'base_price_per_night' , '<', $toAmount ]];
		}
		return $roomTypes->findWhere($query);
	}


	/**
	 * @param mixed $files
	 * @param Model $model
	 *
	 * @return mixed | Collection
	 */
	function addMedia( array $files, Model $model ) {

		if(!$model instanceof RoomType){
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

	/**
	 * @param $id
	 *
	 * @return mixed|RoomType
	 * @throws ModelNotFoundException
	 */
	public function getById( int $id ) {
		return $this->roomTypeRepo->with($this->relations)->find($id);
	}
}