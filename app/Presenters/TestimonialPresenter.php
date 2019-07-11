<?php

namespace Hotel\Presenters;

use Hotel\Transformers\TestimonialTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TestimonialPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class TestimonialPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TestimonialTransformer();
    }
}
