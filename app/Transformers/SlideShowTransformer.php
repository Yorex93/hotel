<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\SlideShow;

/**
 * Class SlideShowTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class SlideShowTransformer extends TransformerAbstract
{
    /**
     * Transform the SlideShow entity.
     *
     * @param \Hotel\Entities\SlideShow $model
     *
     * @return array
     */
    public function transform(SlideShow $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
