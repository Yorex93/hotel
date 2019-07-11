<?php

namespace Hotel\Presenters;

use Hotel\Transformers\ActivitySessionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ActivitySessionPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class ActivitySessionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ActivitySessionTransformer();
    }
}
