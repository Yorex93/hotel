<?php

namespace Hotel\Presenters;

use Hotel\Transformers\RoomServiceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RoomServicePresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class RoomServicePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoomServiceTransformer();
    }
}
