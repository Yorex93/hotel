<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Booking.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property int $hotel_id
 * @property int|null $user_id
 * @property float $total_due
 * @property string $booking_status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\BookingActivity[] $activity
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\BookingRoom[] $rooms
 * @mixin \Eloquent
 */
class Booking extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function rooms(){
    	return $this->hasMany(BookingRoom::class);
    }

    public function activity(){
    	return $this->hasMany(BookingActivity::class);
    }

}
