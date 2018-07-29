<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Booking.
 *
 * @package namespace Hotel\Entities;
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
