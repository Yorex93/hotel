<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 11/08/2018
 * Time: 10:29 PM
 */

namespace Hotel\Services;


use Hotel\Entities\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IncludesMedia {

	/**
	 * @param array $files
	 * @param Model $model
	 *
	 * @return Media | Collection | null
	 */
	function addMedia(array $files, Model $model);

}