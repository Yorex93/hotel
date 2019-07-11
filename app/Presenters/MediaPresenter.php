<?php

namespace Hotel\Presenters;

use Hotel\Transformers\MediaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MediaPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class MediaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MediaTransformer();
    }
}
