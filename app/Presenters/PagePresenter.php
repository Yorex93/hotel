<?php

namespace Hotel\Presenters;

use Hotel\Transformers\PageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PagePresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class PagePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PageTransformer();
    }
}
