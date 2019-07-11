<?php

namespace Hotel\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class RoomTypeValidator.
 *
 * @package namespace Hotel\Validators;
 */
class RoomTypeValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'hotel_id' => 'required | exists:hotels,id',
	        'title' => 'required | min:4',
	        'description' => 'required | string',
	        'max_children' => 'required | integer | max:5',
	        'max_adults' => 'required |integer | max:5',
	        'max_people' => 'required | integer | max:5',
	        'base_price_per_night' => 'required | numeric',
	        'short_description' => 'required | max:140',
	        'is_homepage' => 'boolean'
        ],
        ValidatorInterface::RULE_UPDATE => [
	        'hotel_id' => 'required | exists:hotels,id',
	        'title' => 'required | min:4',
	        'description' => 'required | string',
	        'max_children' => 'required | integer | max:5',
	        'max_adults' => 'required |integer | max:5',
	        'max_people' => 'required | integer | max:5',
	        'base_price_per_night' => 'required | numeric',
	        'is_homepage' => 'boolean',
	        'short_description' => 'required | max:140',
        ],
    ];
}
