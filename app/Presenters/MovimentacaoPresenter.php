<?php

namespace Caderneta\Presenters;

use Caderneta\Transformers\MovimentacaoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MovimentacaoPresenter
 *
 * @package namespace Caderneta\Presenters;
 */
class MovimentacaoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MovimentacaoTransformer();
    }
}
