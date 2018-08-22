<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Room.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property string $room_code
 * @property int $room_type_id
 * @property int $hotel_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Hotel\Entities\RoomType $room_type
 * @property-read \Hotel\Entities\Hotel $hotel
 * @mixin \Eloquent
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

	public function room_type(){
		return $this->belongsTo(RoomType::class);
	}

	public function hotel(){
		return $this->belongsTo(Hotel::class);
	}

	public function booking_rooms(){
		return $this->hasMany(BookingRoom::class);
	}
}
