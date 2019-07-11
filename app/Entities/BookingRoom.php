<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BookingRoom.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property int $booking_id
 * @property int|null $room_type_id
 * @property int|null $room_id
 * @property \Carbon\Carbon|null $check_in
 * @property \Carbon\Carbon|null $check_out
 * @property int $adults
 * @property int $children
 * @property float $amount
 * @property int|null $coupon_id
 * @property float $discount
 * @property float $tax
 * @property float $total
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Hotel\Entities\Booking $booking
 * @property-read \Hotel\Entities\Coupon|null $coupon
 * @property-read \Hotel\Entities\Room|null $room
 * @property-read \Hotel\Entities\RoomType|null $room_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\BookingService[] $services
 * @mixin \Eloquent
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
