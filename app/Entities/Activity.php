<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Activity.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property string $title
 * @property string|null $sub_title
 * @property string $slug
 * @property int $max_children
 * @property int $max_adults
 * @property int $max_people
 * @property string|null $description
 * @property float|null $price_per_person
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $address
 * @property int|null $duration
 * @property int|null $duration_unit_id
 * @property int $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\ActivitySession[] $activitySessions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Review[] $reviews
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Facility[] $tags
 * @mixin \Eloquent
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

	public function tags(){
		return $this->morphToMany(Facility::class, 'taggable');
	}

	public function reviews(){
		return $this->morphToMany(Review::class, 'reviewable');
	}

}
