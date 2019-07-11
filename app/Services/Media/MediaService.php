<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 12/08/2018
 * Time: 12:28 PM
 */

namespace Hotel\Services\Media;


interface MediaService {

	/**
	 * @param array $ids
	 *
	 * @return boolean
	 */
	function deleteAll(array $ids);

}