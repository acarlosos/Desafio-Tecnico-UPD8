<?php

namespace App\Repository;
use App\Models\Representante;
class RepresentanteRepository extends BaseRepository
{
    private $cidadeRepository;

    public function __construct(Representante $representante, CidadeRepository $cidadeRepository) {
        $this->model = $representante;
        $this->cidadeRepository = $cidadeRepository;
    }

    public function create($data)
    {
        $cidade = $this->cidadeRepository->show($data['cidade_id']);
        if($cidade->exists){
            return $cidade->representantes()->create($data);
        }else{
            throw new \Exception("Error Processing Request", 400);
        }
    }

    public function update($id, $data)
    {
        $this->model = $this->show($id);

        if(isset($data['cidade_id'])){
            $cidade = $this->cidadeRepository->show($data['cidade_id']);

            if(!$cidade->exists){
                throw new \Exception("Error Processing Request", 400);
            }
            $this->model->cidades()->detach();
            $this->model->cidades()->attach($cidade->id);
        }
        if($this->model->update($data)){
            return $this->model;
        }else{
            throw new \Exception("Error Processing Request", 400);
        }
    }

    public function delete($id)
    {
        $this->model = $this->show($id);
        $this->model->cidades()->detach();
        if($this->model->delete()){
            return "Resource has deleted";
        }else{
            throw new \Exception("Error Processing Request", 400);
        }
    }
}