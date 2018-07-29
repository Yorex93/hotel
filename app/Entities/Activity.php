<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Activity.
 *
 * @package namespace Hotel\Entities;
 */
class Activity extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

	public function activitySessions(){
		return $this->hasMany(ActivitySession::class);
	}

	public function media(){
		return $this->morphToMany(Media::class, 'has_media');
	}

}
