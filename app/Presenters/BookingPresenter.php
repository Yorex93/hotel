<?php

namespace Hotel\Presenters;

use Hotel\Transformers\BookingTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BookingPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class BookingPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BookingTransformer();
    }
}
