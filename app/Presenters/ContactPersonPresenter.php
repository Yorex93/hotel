<?php

namespace Hotel\Presenters;

use Hotel\Transformers\ContactPersonTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ContactPersonPresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class ContactPersonPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ContactPersonTransformer();
    }
}
