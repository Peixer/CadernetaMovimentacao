<?php

namespace Caderneta\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Movimentacoe extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'movimentacoes';

    protected $fillable = [
        'user_id',
        'descricao',
        'data',
        'tipoCobranca',
        'tipoPagto',
        'total',
        'favorito'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
