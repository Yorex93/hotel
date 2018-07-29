<?php

namespace Hotel\Presenters;

use Hotel\Transformers\TaxTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TaxPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class TaxPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TaxTransformer();
    }
}
