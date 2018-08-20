<?php

namespace Hotel\Presenters;

use Hotel\Transformers\HotelServiceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class HotelServicePresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class HotelServicePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new HotelServiceTransformer();
    }
}
