<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Hotel.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property string $name
 * @property string|null $sub_title
 * @property string $slug
 * @property string|null $description
 * @property string $email
 * @property string|null $phone
 * @property string|null $website
 * @property int|null $parent_hotel_id
 * @property int|null $location_id
 * @property int $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\ActivitySession[] $activitySessions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Facility[] $facilities
 * @property-read \Hotel\Entities\Location|null $location
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Media[] $media
 * @property-read \Hotel\Entities\Hotel|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Review[] $reviews
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\HotelSocial[] $socials
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Tag[] $tags
 * @mixin \Eloquent
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
		return $this->morphToMany(Tag::class, 'taggable', 'taggables');
	}

	public function reviews(){
		return $this->morphToMany(Review::class, 'reviewable', 'reviewables');
	}

	public function facilities(){
		return $this->morphToMany(Facility::class, 'has_facility', 'has_facilities');
	}

	public function media(){
		return $this->morphToMany(Media::class, 'has_media', 'has_media');
	}

	public function roomTypes(){
    	return $this->hasMany(RoomType::class);
	}

	public function rooms(){
    	return $this->hasMany(Room::class, 'hotel_id', 'id');
	}

}
