<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\HotelSettings;

/**
 * Class HotelSettingsTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class HotelSettingsTransformer extends TransformerAbstract
{
    /**
     * Transform the HotelSettings entity.
     *
     * @param \Hotel\Entities\HotelSettings $model
     *
     * @return array
     */
    public function transform(HotelSettings $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
