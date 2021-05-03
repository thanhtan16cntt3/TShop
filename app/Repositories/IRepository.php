<?php
namespace App\Repositories;

interface IRepository{
    public function getAll();
    public function getActive();
    public function find($id);
    public function getBySlug($slug);
    public function create($attributes = []);
    public function update($id, $attributes = []);
    public function delete($id);
}
