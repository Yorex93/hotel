<?php

namespace Hotel\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class HotelServiceValidator.
 *
 * @package namespace Hotel\Validators;
 */
class HotelServiceValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'title' => 'required',
	        'parent' => 'required | exists:hotel_services,id',
	        'short_description' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
	        'title' => 'required',
	        'parent' => 'required | exists:hotel_services,id',
	        'short_description' => 'required'
        ],
    ];
}
