<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\Tag;

/**
 * Class TagTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class TagTransformer extends TransformerAbstract
{
    /**
     * Transform the Tag entity.
     *
     * @param \Hotel\Entities\Tag $model
     *
     * @return array
     */
    public function transform(Tag $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
