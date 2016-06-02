<?php

namespace Caderneta\Http\Controllers\API;

use Caderneta\Http\Controllers\Controller;
use Caderneta\Repositories\UserRepository;
use Caderneta\Http\Requests;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function authenticated()
    {
        $id = Authorizer::getResourceOwnerId();

        return $this->repository->skipPresenter(false)->find($id);
    }
}