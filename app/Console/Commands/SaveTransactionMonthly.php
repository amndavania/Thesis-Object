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
    protected $signature = 'save-transaction-monthly';

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

        $transaction_accounts = TransactionAccount::all();
        foreach ($transaction_accounts as $transaction_account) {
            $transactions = Transaction::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $month)
                ->where('transaction_accounts_id', $transaction_account->id)->get();
            $history = HistoryReport::where('transaction_accounts_id', $transaction_account->id)
                    ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $month)
                    ->where('type', 'monthly')
                    ->first();

            if ($transactions->isNotEmpty()) {
                $totalDebit = $transactions->where('type', 'debit')->sum('amount');
                $totalKredit = $transactions->where('type', 'kredit')->sum('amount');
            } else {
                $totalDebit = 0;
                $totalKredit = 0;
            }

            if ($transaction_account->lajurLaporan == "labaRugi") {
                $totalDebit = -$totalDebit;
                $totalKredit = -$totalKredit;
            }

            if (empty($history)) {
                $saldo = $totalDebit - $totalKredit;
            } else {
                $saldo = $history->saldo + ($totalDebit - $totalKredit);
            }

            $saveData = [
                'transaction_accounts_id' => $transaction_account->id,
                'type' => 'monthly',
                'saldo' => $saldo,
            ];

            try {
                HistoryReport::create($saveData);
            } catch (\Exception $e) {
                echo 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }

    }
}
