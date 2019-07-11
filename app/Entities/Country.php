<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Country.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property string $name
 * @property string|null $country_flag
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Hotel\Entities\State[] $states
 * @mixin \Eloquent
 */
class Country extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function states(){
    	return $this->hasMany(State::class);
    }

}
