<?php

namespace App\Repositories;

interface StudentRepositoryInterface
{
    public function getAll($filters = []);
    public function findById($id);
    public function create(array $data); //ini maksudnya store
    public function update($id, array $data);
    public function delete($id);
    public function hasUkt($id): bool;
}
