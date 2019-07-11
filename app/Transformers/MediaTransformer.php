<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\Media;

/**
 * Class MediaTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class MediaTransformer extends TransformerAbstract
{
    /**
     * Transform the Media entity.
     *
     * @param \Hotel\Entities\Media $model
     *
     * @return array
     */
    public function transform(Media $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
