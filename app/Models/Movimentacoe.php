<?php

namespace Caderneta\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Movimentacoe extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'descricao',
        'data',
        'tipoCobranca',
        'tipoPagto',
        'total'
    ];

    public function getTipoPagto()
    {
        if ($this->tipoPagto == 0)
            return 'Débito';
        if ($this->tipoPagto == 1)
            return 'Crédito';
        if ($this->tipoPagto == 2)
            return 'Cheque';
    }

    public function getTipoCobranca()
    {
        if ($this->tipoCobranca == 0)
            return 'Crédito';
        if ($this->tipoCobranca == 1)
            return 'Débito';
    }

    public function getDateFormated()
    {
        return date("d/m/Y", strtotime($this->data));
    }
}
