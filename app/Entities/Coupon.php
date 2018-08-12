<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Coupon.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property string $title
 * @property string $code
 * @property string|null $description
 * @property float $discount
 * @property string $discount_type
 * @property string $start_time
 * @property string $expiry
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Media[] $media
 * @mixin \Eloquent
 */
class Coupon extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

	public function media(){
		return $this->morphToMany(Media::class, 'has_media');
	}

}
