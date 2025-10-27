<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\HistoryReport;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Report\ReportHelper;


class LabaRugiController extends Controller
{
    use ReportHelper;

    public function index(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $filter = $request->input('filter');

        $getDate = $this->getDate($datepicker, $filter);

        $accounting_group = [
            'pendapatan' => 1,
            'pengeluaran' => 2,
            'penyusutanAmortisasi' => 3,
            'bungaPajak' => 4,
            'pendapatanPengeluaranLain' => 5,
        ];

        $results = $this->setResults($getDate[2], $getDate[0], $accounting_group);

        return view('report.labarugi')->with([
            'pendapatan' => $results['pendapatan'],
            'pengeluaran' => $results['pengeluaran'],
            'penyusutanAmortisasi' => $results['penyusutanAmortisasi'],
            'bungaPajak' => $results['bungaPajak'],
            'pendapatanPengeluaranLain' => $results['pendapatanPengeluaranLain'],
            'datepicker' => $getDate[1],
            'filter' => $getDate[2],
        ]);
    }

    public function export(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $filter = $request->input('filter');

        if ($filter == 'year') {
            $dateTime = DateTime::createFromFormat('Y', $datepicker);
            $date = $dateTime->format('Y');
        } else {
            $dateTime = DateTime::createFromFormat('F Y', $datepicker);
            $date = $dateTime->format('m-Y');
        }

        $getDate = $this->getDate($date, $filter);
        
        $accounting_group = [
            'pendapatan' => 1,
            'pengeluaran' => 2,
            'penyusutanAmortisasi' => 3,
            'bungaPajak' => 4,
            'pendapatanPengeluaranLain' => 5,
        ];

        $results = $this->setResults($getDate[2], $getDate[0], $accounting_group);

        return view('report.printformat.labarugi')->with([
            'pendapatan' => $results['pendapatan'],
            'pengeluaran' => $results['pengeluaran'],
            'penyusutanAmortisasi' => $results['penyusutanAmortisasi'],
            'bungaPajak' => $results['bungaPajak'],
            'pendapatanPengeluaranLain' => $results['pendapatanPengeluaranLain'],
            'datepicker' => $getDate[1],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Neraca"
        ]);
    }

    public function setResults($filter, $date, $accounting_group)
    {
        $results = [];

        foreach ($accounting_group as $key => $value) {
            $getTransaction = $this->getTransaction($date, $filter, $value);

            $transaction_accounts = TransactionAccount::whereHas('accountinggroup', function ($query) use ($value) {
                $query->whereIn('id', [$value]);
            })->get();

            // $transaction_accounts = TransactionAccount::whereHas('transaction', function ($query) use ($getTransaction) {
            //     $transactionAccountsIds = $getTransaction->pluck('transaction_accounts_id')->toArray();
            //     $query->whereIn('transaction_accounts_id', $transactionAccountsIds);
            // })->get();

            $summary = [];
            foreach ($transaction_accounts as $item) {
                $debit = $getTransaction->where('transaction_accounts_id', $item->id)->where('type', 'debit')->sum('amount');
                $kredit = $getTransaction->where('transaction_accounts_id', $item->id)->where('type', 'kredit')->sum('amount');

                $getHistory = $this->getHistory($filter, $item->id, $date);

                if ($item->lajurLaporan == 'labaRugi') {
                    $debit = -$debit;
                    $kredit = -$kredit;
                }

                if (!empty($getHistory)) {
                    $saldo = $getHistory->saldo + ($debit - $kredit);
                } else {
                    $saldo = $debit - $kredit;
                }


                if ($saldo != 0) {
                    $summary[$item->id] = [
                        'name' => $item->name,
                        'saldo' => $saldo,
                        'lajurSaldo' => $item->lajurSaldo,
                    ];
                }
            }

            $results[$key] = $summary;
        }

        return $results;
    }
}
