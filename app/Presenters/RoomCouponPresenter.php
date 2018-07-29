<?php

namespace Hotel\Presenters;

use Hotel\Transformers\RoomCouponTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RoomCouponPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class RoomCouponPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoomCouponTransformer();
    }
}
