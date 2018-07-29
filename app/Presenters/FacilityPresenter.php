<?php

namespace Hotel\Presenters;

use Hotel\Transformers\FacilityTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FacilityPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class FacilityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FacilityTransformer();
    }
}
