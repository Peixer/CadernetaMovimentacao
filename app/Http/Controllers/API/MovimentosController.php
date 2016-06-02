<?php

namespace Caderneta\Http\Controllers\API;

use Caderneta\Http\Controllers\Controller;
use Caderneta\Repositories\MovimentacoeRepository;
use Caderneta\Http\Requests;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class MovimentosController extends Controller
{
    private $repository;

    public function __construct(MovimentacoeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();

        return $this->repository
            ->skipPresenter(false)
            ->scopeQuery(function ($query) use ($id) {
                return $query->where('user_id', '=', $id);
            })->paginate();
    }
}