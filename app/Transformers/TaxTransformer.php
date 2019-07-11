<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\Tax;

/**
 * Class TaxTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class TaxTransformer extends TransformerAbstract
{
    /**
     * Transform the Tax entity.
     *
     * @param \Hotel\Entities\Tax $model
     *
     * @return array
     */
    public function transform(Tax $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
