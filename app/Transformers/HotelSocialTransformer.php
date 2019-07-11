<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\HotelSocial;

/**
 * Class HotelSocialTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class HotelSocialTransformer extends TransformerAbstract
{
    /**
     * Transform the HotelSocial entity.
     *
     * @param \Hotel\Entities\HotelSocial $model
     *
     * @return array
     */
    public function transform(HotelSocial $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
