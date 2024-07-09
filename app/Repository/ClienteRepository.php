<?php

namespace App\Repository;
use App\Models\Cidade;
use App\Models\Cliente;
class ClienteRepository extends BaseRepository
{
    private $cidadeRepository;

    public function __construct(Cliente $cliente, CidadeRepository $cidadeRepository) {
        $this->model = $cliente;
        $this->cidadeRepository = $cidadeRepository;
    }
}