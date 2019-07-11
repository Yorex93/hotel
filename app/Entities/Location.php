<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Location.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string|null $city
 * @property string|null $phone
 * @property string|null $email
 * @property int $state_id
 * @property int $country_id
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Hotel\Entities\ContactPerson $contactPerson
 * @mixin \Eloquent
 */
class Location extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function contactPerson(){
    	return $this->hasOne(ContactPerson::class);
    }

}
