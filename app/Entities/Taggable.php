<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Taggable.
 *
 * @package namespace Hotel\Entities;
 * @property int $tag_id
 * @property int $taggable_id
 * @property int $taggable_type
 * @mixin \Eloquent
 */
class Taggable extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
