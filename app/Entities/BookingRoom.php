<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BookingRoom.
 *
 * @package namespace Hotel\Entities;
 */
class BookingRoom extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

	public function booking(){
		return $this->belongsTo(Booking::class);
	}

	public function room_type(){
		return $this->belongsTo(RoomType::class);
	}

	public function room(){
		return $this->belongsTo(Room::class);
	}

	public function coupon(){
		return $this->belongsTo(Coupon::class);
	}

	public function services(){
		return $this->hasMany(BookingService::class);
	}

}
