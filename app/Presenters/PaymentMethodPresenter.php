<?php

namespace Hotel\Presenters;

use Hotel\Transformers\PaymentMethodTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PaymentMethodPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class PaymentMethodPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PaymentMethodTransformer();
    }
}
