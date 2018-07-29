<?php

namespace Hotel\Presenters;

use Hotel\Transformers\CouponTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CouponPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class CouponPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CouponTransformer();
    }
}
