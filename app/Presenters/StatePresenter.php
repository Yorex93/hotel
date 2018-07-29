<?php

namespace Hotel\Presenters;

use Hotel\Transformers\StateTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StatePresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class StatePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StateTransformer();
    }
}
