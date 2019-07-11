<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Reviewable.
 *
 * @package namespace Hotel\Entities;
 * @property int $review_id
 * @property int $reviewable_id
 * @property string $reviewable_type
 * @mixin \Eloquent
 */
class Reviewable extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
