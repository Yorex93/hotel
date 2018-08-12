<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Service.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $long_description
 * @property int $price_type_id
 * @property float|null $base_price
 * @property float|null $included_tax
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\Media[] $media
 * @mixin \Eloquent
 */
class Service extends Model implements Transformable
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
