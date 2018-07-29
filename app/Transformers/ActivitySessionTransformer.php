<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\ActivitySession;

/**
 * Class ActivitySessionTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class ActivitySessionTransformer extends TransformerAbstract
{
    /**
     * Transform the ActivitySession entity.
     *
     * @param \Hotel\Entities\ActivitySession $model
     *
     * @return array
     */
    public function transform(ActivitySession $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
