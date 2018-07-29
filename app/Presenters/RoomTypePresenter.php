<?php

namespace Hotel\Presenters;

use Hotel\Transformers\RoomTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RoomTypePresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class RoomTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoomTypeTransformer();
    }
}
