<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BookingActivity.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property int $booking_id
 * @property int|null $activity_id
 * @property int|null $activity_session_time_id
 * @property string $activity_date
 * @property int $adults
 * @property int $children
 * @property float $amount
 * @property float $tax
 * @property float $discount
 * @property float $total
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Hotel\Entities\Activity|null $activity
 * @property-read \Hotel\Entities\ActivitySessionTime|null $activity_session_time
 * @property-read \Hotel\Entities\Booking $booking
 * @mixin \Eloquent
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
