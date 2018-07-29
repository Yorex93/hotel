<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\BookingActivity;

/**
 * Class BookingActivityTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class BookingActivityTransformer extends TransformerAbstract
{
    /**
     * Transform the BookingActivity entity.
     *
     * @param \Hotel\Entities\BookingActivity $model
     *
     * @return array
     */
    public function transform(BookingActivity $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
