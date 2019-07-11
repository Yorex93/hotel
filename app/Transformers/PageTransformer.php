<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\Page;

/**
 * Class PageTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class PageTransformer extends TransformerAbstract
{
    /**
     * Transform the Page entity.
     *
     * @param \Hotel\Entities\Page $model
     *
     * @return array
     */
    public function transform(Page $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
