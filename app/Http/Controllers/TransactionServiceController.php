<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\Student;

class TransactionServiceController
{
    public function handleDebitTransaction($user_id, $student, $reference_number, $payment_type, $amount): int
    {
        $description = "Pembayaran " . $payment_type . " " . $student->nim . " " . $student->name;
        $type = "debit";
        $transaction_accounts_id = 1130;

        $this->addTransaction($user_id, $description, $reference_number, $amount, $type, $transaction_accounts_id);
        $latestTransaction = Transaction::latest('id')->first();
        $this->updateTransactionAccount($transaction_accounts_id, $type, $amount);

        return $latestTransaction->id;
    }

    public function handleKreditTransaction($user_id, $student, $reference_number, $payment_type, $amount): int
    {
        $description = "Pendapatan " . $payment_type . " " . $student->nim . " " . $student->name;
        $type = "kredit";
        $transaction_accounts_id = 1120;

        $this->addTransaction($user_id, $description, $reference_number, $amount, $type, $transaction_accounts_id);
        $latestTransaction = Transaction::latest('id')->first();
        $this->updateTransactionAccount($transaction_accounts_id, $type, $amount);

        return $latestTransaction->id;
    }

    public function addTransaction($user_id, $description, $reference_number, $amount, $type, $transaction_accounts_id) //menambahkan data transaksi ke tabel transaction
    {
        Transaction::create([
            'user_id' => $user_id,
            'description' => $description,
            'reference_number' => $reference_number,
            'amount' => $amount,
            'type' => $type,
            'transaction_accounts_id' => $transaction_accounts_id
        ]);
    }

    public function deleteTransaction($transaction_id) //menghapus transaksi berdasarkan id
    {

        $transaction = Transaction::where('id', $transaction_id)->first();
        $transaction->delete();

    }

    public function updateTransactionAccount($transaction_accounts_id, $type, $amount) //mengupdate nilai debit atau kredit pada akun transaksi
    {
        $account = TransactionAccount::findOrFail($transaction_accounts_id);

        if ($type == 'kredit') {
            $ammount = $account->kredit;
            $inputAmount = $ammount + $amount;
            $account->fill(['kredit' => $inputAmount]);
        } elseif ($type == 'debit') {
            $ammount = $account->debit;
            $inputAmount = $ammount + $amount;
            $account->fill(['debit' => $inputAmount]);
        }

        $account->save();
    }
}
