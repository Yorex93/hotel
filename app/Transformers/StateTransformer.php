<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\State;

/**
 * Class StateTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class StateTransformer extends TransformerAbstract
{
    /**
     * Transform the State entity.
     *
     * @param \Hotel\Entities\State $model
     *
     * @return array
     */
    public function transform(State $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
