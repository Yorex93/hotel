<?php

namespace Hotel\Presenters;

use Hotel\Transformers\RoomTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RoomPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class RoomPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoomTransformer();
    }
}
