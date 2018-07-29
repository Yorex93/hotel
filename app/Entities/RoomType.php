<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class RoomType.
 *
 * @package namespace Hotel\Entities;
 */
class RoomType extends Model implements Transformable
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
		return $this->belongsToMany(Service::class, 'room_services', 'room_type_id', 'service_id');
	}

	public function coupons(){
		return $this->belongsToMany(Coupon::class, 'room_coupons', 'room_type_id', 'coupon_id');
	}

	public function media(){
		return $this->morphToMany(Media::class, 'has_media');
	}

	public function tags(){
		return $this->morphToMany(Facility::class, 'taggable');
	}

	public function reviews(){
		return $this->morphToMany(Review::class, 'reviewable');
	}

}
