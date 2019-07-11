<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\HotelService;

/**
 * Class HotelServiceTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class HotelServiceTransformer extends TransformerAbstract
{
    /**
     * Transform the HotelService entity.
     *
     * @param \Hotel\Entities\HotelService $model
     *
     * @return array
     */
    public function transform(HotelService $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
