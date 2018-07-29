<?php

namespace Hotel\Presenters;

use Hotel\Transformers\ReviewTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ReviewPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class ReviewPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ReviewTransformer();
    }
}
