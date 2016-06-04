<?php

namespace Caderneta\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface MovimentacoeRepository
 * @package namespace Caderneta\Repositories;
 */
interface MovimentacoeRepository extends RepositoryInterface
{
    function deletarMovimento($idMovimento, $idUsuario);
    function alterarStatusFavorito($idMovimento, $idUsuario);
}
