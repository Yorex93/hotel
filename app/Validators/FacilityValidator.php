<?php

namespace Hotel\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class FacilityValidator.
 *
 * @package namespace Hotel\Validators;
 */
class FacilityValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'name' => 'required | string'
        ],
        ValidatorInterface::RULE_UPDATE => [
	        'name' => 'required | string'
        ],
    ];
}
