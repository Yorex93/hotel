<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class HasMedia.
 *
 * @package namespace Hotel\Entities;
 * @property int $media_id
 * @property int $has_media_id
 * @property string $has_media_type
 * @mixin \Eloquent
 */
class HasMedia extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
