<?php

namespace Hotel\Presenters;

use Hotel\Transformers\ActivitySessionTimeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ActivitySessionTimePresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class ActivitySessionTimePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ActivitySessionTimeTransformer();
    }
}
