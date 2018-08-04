<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\Testimonial;

/**
 * Class TestimonialTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class TestimonialTransformer extends TransformerAbstract
{
    /**
     * Transform the Testimonial entity.
     *
     * @param \Hotel\Entities\Testimonial $model
     *
     * @return array
     */
    public function transform(Testimonial $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
