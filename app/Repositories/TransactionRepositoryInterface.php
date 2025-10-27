<?php

namespace App\Repositories;

interface TransactionRepositoryInterface
{
    public function create(array $data); //ini store
    public function update(int $id, array $data);
    public function delete(int $id);
    public function updateTransactionAccount(int $transaction_accounts_id, string $type, float $amount): void;
    public function find(int $id);
    public function hasUktRelation(int $id): bool;
}
