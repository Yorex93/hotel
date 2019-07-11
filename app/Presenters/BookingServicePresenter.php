<?php

namespace Hotel\Presenters;

use Hotel\Transformers\BookingServiceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BookingServicePresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class BookingServicePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BookingServiceTransformer();
    }
}
