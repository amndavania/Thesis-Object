<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\Ukt;
use Carbon\Carbon;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function create(array $data)
    {
        // format tanggal
        $data['created_at'] = Carbon::createFromFormat('Y-m-d', $data['created_at'])
            ->setTime(0, 0, 0);

        $transaction = Transaction::create($data);

        // update account balance
        $this->updateTransactionAccount(
            $transaction->transaction_accounts_id,
            $transaction->type,
            $transaction->amount
        );

        return $transaction;
    }

    public function update(int $id, array $data)
    {
        $transaction = Transaction::findOrFail($id);

        // supaya account tidak berubah
        $data['transaction_accounts_id'] = $transaction->transaction_accounts_id;

        $oldAmount = $transaction->amount;
        $newAmount = $data['amount'];
        $amountDiff = $newAmount - $oldAmount;

        $transaction->update($data);

        // update account
        $this->updateTransactionAccount($data['transaction_accounts_id'], $data['type'], $amountDiff);

        return $transaction;
    }

    public function delete(int $id)
    {
        $transaction = Transaction::findOrFail($id);

        $amount = $transaction->amount;
        $this->updateTransactionAccount($transaction->transaction_accounts_id, $transaction->type, -$amount);

        return $transaction->delete();
    }

    public function updateTransactionAccount(int $transaction_accounts_id, string $type, float $amount): void
    {
        $account = TransactionAccount::findOrFail($transaction_accounts_id);

        if ($type === 'kredit') {
            $account->kredit += $amount;
        } elseif ($type === 'debit') {
            $account->debit += $amount;
        }

        $account->save();
    }

    public function find(int $id)
    {
        return Transaction::findOrFail($id);
    }

    public function hasUktRelation(int $id): bool
    {
        return Ukt::where('transaction_debit_id', $id)->exists()
            || Ukt::where('transaction_kredit_id', $id)->exists();
    }
}
