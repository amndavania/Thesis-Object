<?php

namespace App\Repositories;

interface TransactionAccountRepositoryInterface
{
    public function findById($id); //edit
    public function create(array $data, array $accountingGroupIds = []); //store
    public function update($id, array $data, array $accountingGroupIds = []);
    public function delete($id);
    public function hasTransaction($id): bool;
    public function hasHistory($id): bool;
    public function isProtected($id): bool;
}
