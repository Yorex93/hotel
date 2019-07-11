<?php

namespace Hotel\Presenters;

use Hotel\Transformers\EmailTemplateTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EmailTemplatePresenter.
 *
 * @package namespace Hotel\Presenters;
 */
class EmailTemplatePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EmailTemplateTransformer();
    }
}
