<?php

namespace Hotel\Presenters;

use Hotel\Transformers\SlideShowTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SlideShowPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class SlideShowPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SlideShowTransformer();
    }
}
