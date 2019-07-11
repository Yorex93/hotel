<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\Activity;

/**
 * Class ActivityTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class ActivityTransformer extends TransformerAbstract
{
    /**
     * Transform the Activity entity.
     *
     * @param \Hotel\Entities\Activity $model
     *
     * @return array
     */
    public function transform(Activity $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
