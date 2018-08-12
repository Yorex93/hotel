<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 11/08/2018
 * Time: 10:13 PM
 */

namespace Hotel\Dto;


use Symfony\Component\HttpFoundation\File\File;

class FileUpload {

	private $fileName;

	private $fileLocation;

	private $file;

	private $public = false;

	private $storageSystem = "LOCAL";

	public function getFileName(): string{
		return $this->fileName;
	}

	public function setFileName($fileName): void{
		$this->fileName = $fileName;
	}

	/**
	 * @return File
	 */
	public function getFile(): File {
		return $this->file;
	}

	/**
	 * @param File $file
	 */
	public function setFile( File $file ): void {
		$this->file = $file;
	}

	/**
	 * @return mixed
	 */
	public function getFileLocation() {
		return $this->fileLocation;
	}

	/**
	 * @param mixed $fileLocation
	 */
	public function setFileLocation( $fileLocation ): void {
		$this->fileLocation = $fileLocation;
	}

	/**
	 * @return bool
	 */
	public function isPublic(): bool {
		return $this->public;
	}

	/**
	 * @param bool $public
	 */
	public function setPublic( bool $public ): void {
		$this->public = $public;
	}

	/**
	 * @return string
	 */
	public function getStorageSystem(): string {
		return $this->storageSystem;
	}

	/**
	 * @param string $storageSystem
	 */
	public function setStorageSystem( string $storageSystem ): void {
		$this->storageSystem = $storageSystem;
	}

	public function toModelCreateArray(): array{
		return [
			'title' => $this->fileName,
			'mime_type' => $this->getFile()->getMimeType(),
			'size' => $this->getFile()->getSize(),
			'file' => $this->getFileLocation(),
			'is_public' => $this->public,
			'storage_system' => $this->storageSystem
		];
	}

}