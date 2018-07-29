<?php

namespace Hotel\Presenters;

use Hotel\Transformers\HasMediaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class HasMediaPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class HasMediaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new HasMediaTransformer();
    }
}
