<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class RoomType.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property int $hotel_id
 * @property string $title
 * @property string|null $sub_title
 * @property string $slug
 * @property int $max_children
 * @property int $max_adults
 * @property int $max_people
 * @property string|null $description
 * @property float|null $base_price_per_night
 * @property string|null $maintenance_start
 * @property string|null $maintenance_end
 * @property int $is_active
 * @property int $is_homepage
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Coupon[] $coupons
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Facility[] $facilities
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Review[] $reviews
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Service[] $services
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Facility[] $tags
 * @mixin \Eloquent
 */
class RoomType extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

	public function hotel(){
		return $this->belongsTo(Hotel::class);
	}

	public function rooms(){
		return $this->hasMany(Room::class);
	}

	public function facilities(){
		return $this->morphToMany(Facility::class, 'has_facility', 'has_facilities');
	}

	public function services(){
		return $this->belongsToMany(Service::class, 'room_services', 'room_type_id', 'service_id');
	}

	public function coupons(){
		return $this->belongsToMany(Coupon::class, 'room_coupons', 'room_type_id', 'coupon_id');
	}

	public function media(){
		return $this->morphToMany(Media::class, 'has_media', 'has_media');
	}

	public function tags(){
		return $this->morphToMany(Tag::class, 'taggable', 'taggables');
	}

	public function reviews(){
		return $this->morphToMany(Review::class, 'reviewable', 'reviewables');
	}

}
