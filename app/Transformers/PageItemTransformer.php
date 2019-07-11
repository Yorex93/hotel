<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\PageItem;

/**
 * Class PageItemTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class PageItemTransformer extends TransformerAbstract
{
    /**
     * Transform the PageItem entity.
     *
     * @param \Hotel\Entities\PageItem $model
     *
     * @return array
     */
    public function transform(PageItem $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
