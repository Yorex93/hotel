<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class HasFacility.
 *
 * @package namespace Hotel\Entities;
 * @property int $facility_id
 * @property int $has_facility_id
 * @property string $has_facility_type
 * @mixin \Eloquent
 */
class HasFacility extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
