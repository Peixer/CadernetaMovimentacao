<?php

namespace Caderneta\Transformers;

use Caderneta\Models\Movimentacoe;
use League\Fractal\TransformerAbstract;

/**
 * Class MovimentacaoTransformer
 * @package namespace Caderneta\Transformers;
 */
class MovimentacaoTransformer extends TransformerAbstract
{

    /**
     * Transform the \Movimentacao entity
     * @param \Movimentacao $model
     *
     * @return array
     */
    public function transform(Movimentacoe $model)
    {
        return [
            'id' => (int)$model->id,
            'descricao' => $model->descricao,
            'data' => date("Y/m/d", strtotime($model->data)),
            'total' => (float)$model->total,
            'favorito' => (boolean)$model->favorito,
            'tipoCobranca' => (boolean)$model->tipoCobranca,
        ];
    }
}
