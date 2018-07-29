<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\RoomCoupon;

/**
 * Class RoomCouponTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class RoomCouponTransformer extends TransformerAbstract
{
    /**
     * Transform the RoomCoupon entity.
     *
     * @param \Hotel\Entities\RoomCoupon $model
     *
     * @return array
     */
    public function transform(RoomCoupon $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
