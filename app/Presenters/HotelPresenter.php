<?php

namespace Hotel\Presenters;

use Hotel\Transformers\HotelTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class HotelPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class HotelPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new HotelTransformer();
    }
}
