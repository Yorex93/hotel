<?php

namespace Hotel\Presenters;

use Hotel\Transformers\HotelSocialTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class HotelSocialPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class HotelSocialPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new HotelSocialTransformer();
    }
}
