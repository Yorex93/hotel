<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\RoomType;

/**
 * Class RoomTypeTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class RoomTypeTransformer extends TransformerAbstract
{
    /**
     * Transform the RoomType entity.
     *
     * @param \Hotel\Entities\RoomType $model
     *
     * @return array
     */
    public function transform(RoomType $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
