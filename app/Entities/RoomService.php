<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class RoomService.
 *
 * @package namespace Hotel\Entities;
 * @property int $room_type_id
 * @property int $service_id
 * @mixin \Eloquent
 */
class RoomService extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
