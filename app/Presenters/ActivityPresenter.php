<?php

namespace Hotel\Presenters;

use Hotel\Transformers\ActivityTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ActivityPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class ActivityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ActivityTransformer();
    }
}
