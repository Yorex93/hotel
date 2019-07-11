<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 11/08/2018
 * Time: 9:59 PM
 */

namespace Hotel\Services\File;

use Defuse\Crypto\Exception\IOException;
use Hotel\Dto\FileUpload;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

interface FileService{

	/**
	 * @param UploadedFile $file
	 *
	 * @param string|null $location
	 *
	 * @return FileUpload
	 * @throws FileException
	 */
	function saveFile(UploadedFile $file, $location = null): FileUpload;

	/**
	 * @param $mediaId
	 *
	 * @return mixed
	 * @throws IOException
	 */
	function downloadFile($mediaId);

	/**
	 * @param string $location
	 *
	 * @return boolean
	 */
	function deleteFileInLocation($location);

	/**
	 * @param $mediaId
	 *
	 * @return boolean
	 */
	function deleteFile($mediaId);

}