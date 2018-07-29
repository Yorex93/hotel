<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Room.
 *
 * @package namespace Hotel\Entities;
 */
class Room extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

	public function facilities(){
		return $this->morphToMany(Facility::class, 'has_facility');
	}

    public function services(){
    	return $this->belongsToMany(Service::class, 'room_services', 'room_id', 'service_id');
    }

}
