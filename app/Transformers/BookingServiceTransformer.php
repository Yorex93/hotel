<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\BookingService;

/**
 * Class BookingServiceTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class BookingServiceTransformer extends TransformerAbstract
{
    /**
     * Transform the BookingService entity.
     *
     * @param \Hotel\Entities\BookingService $model
     *
     * @return array
     */
    public function transform(BookingService $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
