<?php

namespace App\Repository;

abstract class BaseRepository
{
    protected $model;
    public function index()
    {
        return $this->model->orderBy('uf')->get();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, $data)
    {
        $this->model = $this->show($id);
        if($this->model->update($data)){
            return $this->model;
        }else{
            throw new \Exception("Error Processing Request", 400);
        }
    }

    public function delete($id)
    {
        $this->model = $this->show($id);
        if($this->model->delete()){
            return "Resource has deleted";
        }else{
            throw new \Exception("Error Processing Request", 400);
        }
    }
}