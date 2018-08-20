<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class HotelService.
 *
 * @package namespace Hotel\Entities;
 */
class HotelService extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function media(){
	    return $this->morphToMany(Media::class, 'has_media', 'has_media');
    }

    public function parent_service(){
	    return $this->hasOne(HotelService::class, 'id', 'parent');
    }

    public function children(){
	    return $this->hasMany(HotelService::class, 'parent', 'id');
    }

}
