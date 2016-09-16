<?php

namespace Caderneta\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface MovimentacoeRepository
 * @package namespace Caderneta\Repositories;
 */
interface MovimentacoeRepository extends RepositoryInterface
{
    function getHistoric($id, $mes);
    function getReport($request, $id);
    function deletarMovimento($idMovimento, $idUsuario);
    function alterarStatusFavorito($idMovimento, $idUsuario);
}
