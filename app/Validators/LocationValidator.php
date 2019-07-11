<?php

namespace Hotel\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class LocationValidator.
 *
 * @package namespace Hotel\Validators;
 */
class LocationValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'name' => 'required',
	        'address'=>'required',
	        'country_id' => 'required | exists:countries,id',
	        'state_id' => 'required | exists:states,id',
	        'email' => 'required | email',
	        'phone' => 'required',
	        'latitude' => 'nullable | numeric',
	        'longitude' => 'nullable | numeric',
        ],
        ValidatorInterface::RULE_UPDATE => [
	        'name' => 'required',
	        'address'=>'required',
	        'country_id' => 'required | exists:countries,id',
	        'state_id' => 'required | exists:states,id',
	        'email' => 'required | email',
	        'phone' => 'required',
	        'latitude' => 'nullable | numeric',
	        'longitude' => 'nullable | numeric',
        ],
    ];
}
