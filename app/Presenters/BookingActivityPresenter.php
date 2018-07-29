<?php

namespace Hotel\Presenters;

use Hotel\Transformers\BookingActivityTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BookingActivityPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class BookingActivityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BookingActivityTransformer();
    }
}
