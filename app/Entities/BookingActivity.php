<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BookingActivity.
 *
 * @package namespace Hotel\Entities;
 */
class BookingActivity extends Model implements Transformable
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

    public function activity(){
    	return $this->belongsTo(Activity::class);
    }

	public function activity_session_time(){
		return $this->belongsTo(ActivitySessionTime::class);
	}

}
