<?php

namespace Hotel\Transformers;

use League\Fractal\TransformerAbstract;
use Hotel\Entities\ContactPerson;

/**
 * Class ContactPersonTransformer.
 *
 * @package namespace Hotel\Transformers;
 */
class ContactPersonTransformer extends TransformerAbstract
{
    /**
     * Transform the ContactPerson entity.
     *
     * @param \Hotel\Entities\ContactPerson $model
     *
     * @return array
     */
    public function transform(ContactPerson $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
