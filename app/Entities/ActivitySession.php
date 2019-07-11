<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ActivitySession.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property int $activity_id
 * @property int $hotel_id
 * @property string $start_date
 * @property string $end_date
 * @property string|null $days
 * @property float|null $price_per_adult
 * @property float|null $price_per_child
 * @property float|null $discount
 * @property string|null $discount_type
 * @property float|null $included_vat
 * @property int $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Activity[] $activity
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\ActivitySessionTime[] $times
 * @mixin \Eloquent
 */
class ActivitySession extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function activity(){
    	return $this->hasMany(Activity::class);
    }

    public function times(){
    	return $this->hasMany(ActivitySessionTime::class);
    }

}
