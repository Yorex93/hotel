<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\Review;

/**
 * Class ReviewTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class ReviewTransformer extends TransformerAbstract
{
    /**
     * Transform the Review entity.
     *
     * @param \Hotel\Entities\Review $model
     *
     * @return array
     */
    public function transform(Review $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
