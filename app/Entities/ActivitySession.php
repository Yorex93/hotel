<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ActivitySession.
 *
 * @package namespace Hotel\Entities;
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
