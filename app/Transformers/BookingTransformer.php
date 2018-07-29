<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\Booking;

/**
 * Class BookingTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class BookingTransformer extends TransformerAbstract
{
    /**
     * Transform the Booking entity.
     *
     * @param \Hotel\Entities\Booking $model
     *
     * @return array
     */
    public function transform(Booking $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
