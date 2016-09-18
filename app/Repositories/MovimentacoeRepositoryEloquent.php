<?php

namespace Caderneta\Repositories;

use Caderneta\Models\Movimentacoe;
use Carbon\Carbon;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class MovimentacoeRepositoryEloquent
 * @package namespace Caderneta\Repositories;
 */
class MovimentacoeRepositoryEloquent extends BaseRepository implements MovimentacoeRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Movimentacoe::class;
    }

    public function presenter()
    {
//        return MovimentacaoPresenter::class;
        return null;
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
        $endDate = Carbon::createFromFormat("d/m/Y", $request['end'])->toDateString();
        $startDate = Carbon::createFromFormat("d/m/Y", $request['start'])->toDateString();
        $tags = $request['tags'];

        $movimentacoes = $this->model->where('user_id', $id)
            ->whereBetween('data', [$startDate, $endDate])->get();

        return $this->obterMovimentacoesRelacionadasTags($movimentacoes, $tags);;
    }

    public function deletarMovimento($idMovimento, $idUsuario)
    {
        return $this->model->where('user_id', $idUsuario)
            ->where('id', $idMovimento)
            ->delete();
    }

    function alterarStatusFavorito($idMovimento, $idUsuario)
    {
        $movimento = $this->model
            ->where('user_id', $idUsuario)
            ->where('id', $idMovimento)
            ->first();

        $movimento->favorito = !$movimento->favorito;
        $movimento->save();

        return $this->skipPresenter(false)->parserResult($movimento);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $movimentacoes
     * @param $tags
     * @param $resultado
     * @return array
     */
    private function obterMovimentacoesRelacionadasTags($movimentacoes, $tags)
    {
        $resultado = [];

        if (empty($tags)) {
            if ($movimentacoes == null)
                return array();

            return $movimentacoes;
        }

        foreach ($movimentacoes as $movimento) {
            foreach ($tags as $tag) {

                $tag = str_replace('#', '', $tag);
                $descricaoMaiusculo = strtolower($movimento->descricao);
                $tagMaiusculo = strtolower($tag);

                if (str_contains($descricaoMaiusculo, $tagMaiusculo)) {
                    if (array_key_exists($tag, $resultado))
                        array_push($resultado[$tag], $movimento);
                    else
                        $resultado = array_add($resultado, $tag, array($movimento));
                }
            }
        }

        return $resultado;
    }
}
