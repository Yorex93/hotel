<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\ActivitySessionTime;

/**
 * Class ActivitySessionTimeTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class ActivitySessionTimeTransformer extends TransformerAbstract
{
    /**
     * Transform the ActivitySessionTime entity.
     *
     * @param \Hotel\Entities\ActivitySessionTime $model
     *
     * @return array
     */
    public function transform(ActivitySessionTime $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
