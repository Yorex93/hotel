<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\RoomService;

/**
 * Class RoomServiceTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class RoomServiceTransformer extends TransformerAbstract
{
    /**
     * Transform the RoomService entity.
     *
     * @param \Hotel\Entities\RoomService $model
     *
     * @return array
     */
    public function transform(RoomService $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
