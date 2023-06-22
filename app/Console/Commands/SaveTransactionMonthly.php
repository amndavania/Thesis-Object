<?php

namespace App\Console\Commands;

use App\Models\HistoryReport;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SaveTransactionMonthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:save-transaction-monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $dateToday = Carbon::today();
        $month = $dateToday->subMonth()->format('Y-m');
        // $previousMonth = $dateToday->subMonth(2)->format('Y-m');

        $transaction_accounts = TransactionAccount::all();
        foreach ($transaction_accounts as $transaction_account) {
            $transactions = Transaction::where('transaction_accounts_id', $transaction_account->id)
                    ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $month)
                    ->get();
            $history = HistoryReport::where('transaction_accounts_id', $transaction_account->id)
                    ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $month)
                    ->where('type', 'monthly')
                    ->first();
            
            if (empty($history)) {
                $totalDebit = 0;
                $totalKredit = 0;
            } else {
                $totalDebit = $history->debit;
                $totalKredit = $history->kredit;
            }

            if (!empty($transactions)) {
                foreach ($transactions as $transaction) {
                    if ($transaction->type == "debit") {
                        $totalDebit += $transaction->amount;
                    } elseif ($transaction->type == "kredit") {
                        $totalKredit += $transaction->amount;
                    }
                }
            }

            $saveData = [
                'transaction_accounts_id' => $transaction_account->id,
                'type' => 'monthly',
                'kredit' => $totalKredit,
                'debit' => $totalDebit
            ];
            
            try {
                HistoryReport::create($saveData);
            } catch (\Exception $e) {
                echo 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }

    }
}
