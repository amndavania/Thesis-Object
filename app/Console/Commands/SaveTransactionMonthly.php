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

        $transaction_accounts = TransactionAccount::where('name', '!=', 'labaDitahan')->get();
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
                $transaction_account->update([
                    'kredit' => 0,
                    'debit' => 0,
                ]);
            } catch (\Exception $e) {
                echo 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }

        // Save laba ditahan perbulan
        $labaBerjalan = 0;
        $accounting_group_laba = [
            'pendapatan' => 1,
            'pengeluaran' => 2,
            'penyusutanAmortisasi' => 3,
            'bungaPajak' => 4,
            'pendapatanPengeluaranLain' => 5,
        ];

        $labaDitahan = HistoryReport::where('transaction_accounts_id', 9999)
                ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $month)
                ->where('type', 'monthly')
                ->select('saldo')
                ->first();
    
        if (empty($labaDitahan)) {
            $labaDitahan = 0;
        } else{
            $labaDitahan = $labaDitahan->saldo;
        }
        
        foreach ($accounting_group_laba as $key => $value) {

            $getTransaction = Transaction::whereHas('transactionaccount.accountinggroup', function ($query) use ($value) {
                $query->where('accounting_groups.id', $value);
            })
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $month)
            ->get();
            

            $transaction_accounts = TransactionAccount::whereHas('accountinggroup', function ($query) use ($value) {
                $query->whereIn('id', [$value]);
            })->get();

            
            foreach ($transaction_accounts as $item) {
                $debit = $getTransaction->where('transaction_accounts_id', $item->id)->where('type', 'debit')->sum('amount');
                $kredit = $getTransaction->where('transaction_accounts_id', $item->id)->where('type', 'kredit')->sum('amount');

                $saldo = $kredit - $debit;

                if ($saldo != 0) {
                    $labaBerjalan += $saldo;
                }
            }

        }
        $labaAkhir = $labaDitahan + $labaBerjalan;
        
        $saveLaba = [
            'transaction_accounts_id' => 9999,
            'type' => 'monthly',
            'saldo' => $labaAkhir,
        ];

        try {
            HistoryReport::create($saveLaba);
        } catch (\Exception $e) {
            echo 'Terjadi kesalahan: ' . $e->getMessage();
        }
    }
}
