<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ContactPerson.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property int|null $location_id
 * @property string|null $email
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string $phone_number
 * @property string|null $title
 * @property int $is_public
 * @property int $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @mixin \Eloquent
 */
class ContactPerson extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
