<?php

namespace App\Repository;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
class ClienteRepository extends BaseRepository
{
    private $cidadeRepository;
    private $query;

    public function __construct(Cliente $cliente, CidadeRepository $cidadeRepository) {
        $this->model = $cliente;
        $this->cidadeRepository = $cidadeRepository;
    }

    public function search($data)
    {
        $this->query = $this->model->query();
        return $this->query
            ->when($data['nome'] ?? '', fn ($query, $searchNome) => $this->searchTerm($searchNome, 'nome'))
            ->when($data['cpf'] ?? '', fn ($query, $searchCpf) => $this->searchTerm($searchCpf, 'cpf'))
            ->when($data['cidade_id'] ?? '', fn ($query, $searchcidade) => $this->searchExactTerm($searchcidade, 'cidade_id'))
            ->when($data['sexo'] ?? '', fn ($query, $searchSexo) => $this->searchExactTerm($searchSexo, 'sexo'))
            ->when($data['data_nascimento'] ?? '', fn ($query, $searchNascimento) => $this->searchDate($searchNascimento))
            ->when($data['uf'] ?? '', fn ($query, $searchUf) => $this->searchUf($searchUf))
            ->paginate($data['per_page'] ?? 10)
            ->withQueryString();
    }

    private function searchUf(string $searchTerm): Builder
    {
        if(!empty($searchTerm)){
            return $this->query
                ->whereHas('cidade', fn ($query) => $query->where('uf', $searchTerm));
        }
        return $this->query;
    }
    private function searchTerm(string $searchTerm, $field): Builder
    {
        return $this->query
            ->where($field, 'like', "%$searchTerm%");
    }

    private function searchExactTerm(string $searchTerm, $field): Builder
    {
        return $this->query
            ->where($field,$searchTerm);
    }

    private function searchDate(string $searchTerm): Builder
    {
        return $this->query
            ->where('data_nascimento', Carbon::createFromDate($searchTerm));
    }
}