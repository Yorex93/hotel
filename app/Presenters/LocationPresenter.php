<?php

namespace Hotel\Presenters;

use Hotel\Transformers\LocationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LocationPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class LocationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LocationTransformer();
    }
}
