<?php

namespace App\Contracts;

interface CrudRepositoryInterface
{
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function find($id);
    public function updateOrCreate(array $values);
    public function all();
}
