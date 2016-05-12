<?php

namespace Caderneta\Repositories;

use Carbon\Carbon;
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

    public function getReport($request, $id)
    {
        $result = [];
        $endDate = Carbon::createFromFormat("d/m/Y", $request['end'])->toDateString();
        $startDate = Carbon::createFromFormat("d/m/Y", $request['start'])->toDateString();
        $tags = $request['tags'];

        $movimentacoes = $this->model->where('user_id', $id)
            ->whereBetween('data', [$startDate, $endDate])->get();

        foreach ($movimentacoes as $movimento) {
            foreach ($tags as $tag) {
                $tag = str_replace('#', '', $tag);

                if (str_contains(strtolower($movimento->descricao), strtolower($tag))) {
                    if (array_key_exists($tag, $result))
                        array_push($result[$tag], $movimento);
                    else
                        $result = array_add($result, $tag, array($movimento));
                }
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
