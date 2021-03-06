<?php

namespace Caderneta\Http\Controllers\API;

use Caderneta\Http\Controllers\Controller;
use Caderneta\Repositories\MovimentacoeRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Requests;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class MovimentosController extends Controller
{
    private $repository;

    public function __construct(MovimentacoeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listar()
    {
        $id = Authorizer::getResourceOwnerId();

        return $this->repository
            ->skipPresenter(false)
            ->scopeQuery(function ($query) use ($id) {
                return $query->where('user_id', '=', $id);
            })->paginate(10);
    }

    public function obterMovimentosFavoritos()
    {
        $id = Authorizer::getResourceOwnerId();

        return $this->repository
            ->skipPresenter(false)
            ->scopeQuery(function ($query) use ($id) {
                return $query->where('user_id', '=', $id)->where('favorito', '=', true);
            })->paginate();
    }

    public function deletarMovimento($id)
    {
        $idUsuario = Authorizer::getResourceOwnerId();

        return $this->repository->deletarMovimento($id, $idUsuario);
    }

    public function alterarStatusFavorito($id)
    {
        $idUsuario = Authorizer::getResourceOwnerId();

        $this->repository->alterarStatusFavorito($id, $idUsuario);
    }

    public function inserirOuAtualizar(Request $request)
    {
        $idUsuario = Authorizer::getResourceOwnerId();

        $data = $request->all();
        $data['user_id'] = $idUsuario;

        return $this->repository->updateOrCreate(['id' => $data['id']], $data);
    }
}