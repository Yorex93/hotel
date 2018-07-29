<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\Facility;

/**
 * Class FacilityTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class FacilityTransformer extends TransformerAbstract
{
    /**
     * Transform the Facility entity.
     *
     * @param \Hotel\Entities\Facility $model
     *
     * @return array
     */
    public function transform(Facility $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
