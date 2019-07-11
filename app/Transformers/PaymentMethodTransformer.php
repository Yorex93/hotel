<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\PaymentMethod;

/**
 * Class PaymentMethodTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class PaymentMethodTransformer extends TransformerAbstract
{
    /**
     * Transform the PaymentMethod entity.
     *
     * @param \Hotel\Entities\PaymentMethod $model
     *
     * @return array
     */
    public function transform(PaymentMethod $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
