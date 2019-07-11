<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 12/08/2018
 * Time: 12:29 PM
 */

namespace Hotel\Services\Media;


use Hotel\Entities\Media;
use Hotel\Repositories\MediaRepository;
use Hotel\Services\File\FileService;

class DefaultMediaService implements MediaService {

	protected $mediaRepo;
	protected $fileService;

	public function __construct(MediaRepository $media_repository, FileService $file_service) {
		$this->mediaRepo = $media_repository;
		$this->fileService = $file_service;
	}

	/**
	 * @param array $ids
	 *
	 * @return boolean
	 */
	function deleteAll( array $ids ) {
		$media = $this->mediaRepo->findWhereIn('id', $ids);
		foreach($media AS $mediaFile){
			if($mediaFile instanceof Media){
				if($this->fileService->deleteFileInLocation($mediaFile->file)){
					try {
						$mediaFile->delete();
					} catch ( \Exception $e ) {

					}
				}
			}
		}
		return true;
	}
}