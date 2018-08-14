<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 11/08/2018
 * Time: 10:00 PM
 */

namespace Hotel\Services\File;


use Defuse\Crypto\Exception\IOException;
use Hotel\Dto\FileUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class LocalStorageFileService implements FileService {

	/**
	 * @param UploadedFile $file
	 *
	 * @param string|null $location
	 *
	 * @return FileUpload
	 * @throws FileException
	 */
	function saveFile( UploadedFile $file, $location = null ): FileUpload {
		$title = $file->getClientOriginalName();
		$saveTo = 'files';
		if($location){
			$saveTo = $saveTo."/".$location;
		}
		//$filename = uniqid().".".$file->getClientOriginalExtension();
		$uploadedFile = $file->store($saveTo, 'public');
		$fileUpload = new FileUpload();
		$fileUpload->setFileSize($file->getSize());
		$fileUpload->setMimeType($file->getMimeType());
		$fileUpload->setFileName($title);
		$fileUpload->setFileLocation($uploadedFile);
		$fileUpload->setPublic(true);
		return $fileUpload;
	}


	/**
	 * @param $mediaId
	 *
	 * @return mixed
	 */
	function downloadFile( $mediaId ) {
		// TODO: Implement downloadFile() method.
	}

	/**
	 * @param $mediaId
	 *
	 * @return boolean
	 */
	function deleteFile( $mediaId ) {
		// TODO: Implement deleteFile() method.
	}

	/**
	 * @param string $location
	 *
	 * @return boolean
	 */
	function deleteFileInLocation( $location ) {
		return Storage::disk('public')->delete($location);
	}
}