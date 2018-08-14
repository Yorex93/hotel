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


	private $public = false;

	private $fileSize;

	private $mimeType;

	/**
	 * @return mixed
	 */
	public function getFileSize() {
		return $this->fileSize;
	}

	/**
	 * @param mixed $fileSize
	 */
	public function setFileSize( $fileSize ): void {
		$this->fileSize = $fileSize;
	}

	/**
	 * @return mixed
	 */
	public function getMimeType() {
		return $this->mimeType;
	}

	/**
	 * @param mixed $mimeType
	 */
	public function setMimeType( $mimeType ): void {
		$this->mimeType = $mimeType;
	}

	private $storageSystem = "LOCAL";

	public function getFileName(): string{
		return $this->fileName;
	}

	public function setFileName($fileName): void{
		$this->fileName = $fileName;
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
			'mime_type' => $this->getMimeType(),
			'size' => $this->getFileSize(),
			'file' => $this->getFileLocation(),
			'is_public' => $this->public,
			'storage_system' => $this->storageSystem
		];
	}

}