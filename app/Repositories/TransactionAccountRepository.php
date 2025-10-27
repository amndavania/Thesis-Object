<?php

namespace App\Repositories;

use App\Models\TransactionAccount;
use App\Models\Transaction;
use App\Models\HistoryReport;

class TransactionAccountRepository implements TransactionAccountRepositoryInterface
{
    protected $model;

    public function __construct(TransactionAccount $model)
    {
        $this->model = $model;
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data, array $accountingGroupIds = [])
    {
        $data['kredit'] = 0;
        $data['debit'] = 0;

        $transactionAccount = $this->model->create($data);

        if (!empty($accountingGroupIds)) {
            $transactionAccount->accountinggroup()->sync($accountingGroupIds);
        }

        return $transactionAccount;
    }

    public function update($id, array $data, array $accountingGroupIds = [])
    {
        $transactionAccount = $this->findById($id);

        $transactionAccount->update($data);

        if (!empty($accountingGroupIds)) {
            $transactionAccount->accountinggroup()->sync($accountingGroupIds);
        }

        return $transactionAccount;
    }

    public function delete($id)
    {
        $transactionAccount = $this->findById($id);
        return $transactionAccount->delete();
    }

    public function hasTransaction($id): bool
    {
        return Transaction::where('transaction_accounts_id', $id)->exists();
    }

    public function hasHistory($id): bool
    {
        return HistoryReport::where('transaction_accounts_id', $id)->exists();
    }

    public function isProtected($id): bool
    {
        return in_array($id, [1130, 1120, 9999]);
    }
}
