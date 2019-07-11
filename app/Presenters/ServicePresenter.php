<?php

namespace Hotel\Presenters;

use Hotel\Transformers\ServiceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ServicePresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class ServicePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ServiceTransformer();
    }
}
