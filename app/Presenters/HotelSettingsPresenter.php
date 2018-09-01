<?php

namespace Hotel\Presenters;

use Hotel\Transformers\HotelSettingsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class HotelSettingsPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class HotelSettingsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new HotelSettingsTransformer();
    }
}
