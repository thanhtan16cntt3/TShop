<?php
namespace App\Repositories;

abstract class BaseRepository implements IRepository{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    public function setModel(){
        $this->model = $this->getModel();
    }

    abstract public function getModel();

    public function getAll(){
        return $this->model::all();
    }

    public function find($id){
        return $this->model::findOrFail($id);
    }

    public function create($attributes = []){
        return $this->model::create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
