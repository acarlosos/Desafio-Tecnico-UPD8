<?php

namespace App\Repository;
use App\Models\Cidade;
class CidadeRepository extends BaseRepository
{
    public function __construct(Cidade $cidade) {
        $this->model = $cidade;
    }
}