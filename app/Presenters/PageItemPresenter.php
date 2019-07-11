<?php

namespace Hotel\Presenters;

use Hotel\Transformers\PageItemTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PageItemPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class PageItemPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PageItemTransformer();
    }
}
