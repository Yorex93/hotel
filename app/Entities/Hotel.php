<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Hotel.
 *
 * @package namespace Hotel\Entities;
 */
class Hotel extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [];

    public function location(){
    	return $this->belongsTo(Location::class);
    }

    public function parent(){
    	return $this->belongsTo(Hotel::class, 'parent_hotel_id', 'id');
    }

    public function activities(){
    	return $this->belongsToMany(Activity::class, 'hotel_activities', 'hotel_id', 'activity_id');
    }

	public function activitySessions(){
		return $this->hasMany(ActivitySession::class);
	}

	public function socials(){
		return $this->hasMany(HotelSocial::class);
	}

	public function tags(){
		return $this->morphToMany(Facility::class, 'taggable');
	}

	public function reviews(){
		return $this->morphToMany(Review::class, 'reviewable');
	}

	public function facilities(){
		return $this->morphToMany(Facility::class, 'has_facility');
	}

	public function media(){
		return $this->morphToMany(Media::class, 'has_media');
	}

}
