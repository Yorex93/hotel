<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Review.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property string $reviewer
 * @property string|null $reviewer_phone
 * @property string|null $reviewer_email
 * @property string|null $comment
 * @property int $rating
 * @property int $is_approved
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @mixin \Eloquent
 */
class Review extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
