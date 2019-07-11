<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\Service;

/**
 * Class ServiceTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class ServiceTransformer extends TransformerAbstract
{
    /**
     * Transform the Service entity.
     *
     * @param \Hotel\Entities\Service $model
     *
     * @return array
     */
    public function transform(Service $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
