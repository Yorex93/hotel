<?php

namespace Hotel\Presenters;

use Hotel\Transformers\PaymentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PaymentPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class PaymentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PaymentTransformer();
    }
}
