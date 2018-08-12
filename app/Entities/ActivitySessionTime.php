<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ActivitySessionTime.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property int $activity_session_id
 * @property string $start_time
 * @property string $finish_time
 * @property int $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Hotel\Entities\ActivitySession $activity_session
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\BookingActivity[] $booking_activities
 * @mixin \Eloquent
 */
class ActivitySessionTime extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function activity_session(){
    	return $this->belongsTo(ActivitySession::class);
    }

    public function booking_activities(){
    	return $this->hasMany(BookingActivity::class);
    }


}
