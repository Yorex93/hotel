<?php

namespace Hotel\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class HotelValidator.
 *
 * @package namespace Hotel\Validators;
 */
class HotelValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'name' => 'required | min:4',
	        'description' => 'required | min:100',
	        'email' => 'required | email',
	        'phone' => 'required',
	        'parent_hotel_id' => 'nullable | numeric | exists:hotels,id'
        ],
        ValidatorInterface::RULE_UPDATE => [
	        'name' => 'required | min:4',
	        'description' => 'required | min:100',
	        'email' => 'required | email',
	        'phone' => 'required',
	        'parent_hotel_id' => 'nullable | numeric | exists:hotels,id'
        ],
    ];
}
