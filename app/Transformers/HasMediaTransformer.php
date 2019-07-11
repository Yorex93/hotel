<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\HasMedia;

/**
 * Class HasMediaTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class HasMediaTransformer extends TransformerAbstract
{
    /**
     * Transform the HasMedia entity.
     *
     * @param \Hotel\Entities\HasMedia $model
     *
     * @return array
     */
    public function transform(HasMedia $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
