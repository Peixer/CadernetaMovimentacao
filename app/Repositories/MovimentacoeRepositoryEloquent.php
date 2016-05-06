<?php

namespace Caderneta\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Caderneta\Repositories\MovimentacoeRepository;
use Caderneta\Models\Movimentacoe;

/**
 * Class MovimentacoeRepositoryEloquent
 * @package namespace Caderneta\Repositories;
 */
class MovimentacoeRepositoryEloquent extends BaseRepository implements MovimentacoeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Movimentacoe::class;
    }

    public function getHistoric($id, $mes)
    {
        $result = [];

        $movimentacoes = $this->model->where('user_id', $id)->get();

        foreach ($movimentacoes as $movimento) {
            $month = date("m", strtotime($movimento->data));

            if ($month == $mes) {
                array_push($result, $movimento);
            }
        }

        return $result;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
