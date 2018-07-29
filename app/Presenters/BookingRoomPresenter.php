<?php

namespace Hotel\Presenters;

use Hotel\Transformers\BookingRoomTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BookingRoomPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class BookingRoomPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BookingRoomTransformer();
    }
}
