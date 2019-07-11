<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BookingService.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property int $booking_room_id
 * @property int $service_id
 * @property int $quantity
 * @property float $unit_price
 * @property float $tax
 * @property float $total_amount
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Hotel\Entities\BookingRoom $booking_room
 * @property-read \Hotel\Entities\Service $service
 * @mixin \Eloquent
 */
class BookingService extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function booking_room(){
    	return $this->belongsTo(BookingRoom::class);
    }

    public function service(){
    	return $this->belongsTo(Service::class);
    }

}
