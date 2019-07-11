<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\Payment;

/**
 * Class PaymentTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class PaymentTransformer extends TransformerAbstract
{
    /**
     * Transform the Payment entity.
     *
     * @param \Hotel\Entities\Payment $model
     *
     * @return array
     */
    public function transform(Payment $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
