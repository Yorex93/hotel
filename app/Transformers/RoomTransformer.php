<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\Room;

/**
 * Class RoomTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class RoomTransformer extends TransformerAbstract
{
    /**
     * Transform the Room entity.
     *
     * @param \Hotel\Entities\Room $model
     *
     * @return array
     */
    public function transform(Room $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
