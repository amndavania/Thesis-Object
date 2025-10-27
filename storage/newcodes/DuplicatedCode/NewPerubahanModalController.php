<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\HistoryReport;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Report\ReportHelper;


class PerubahanModalController extends Controller
{
    use ReportHelper;

    public function index(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $filter = $request->input('filter');

        $getDate = $this->getDate($datepicker, $filter);

        $accounting_group = [
            'modal' => 17,
            'penguranganModal' => 18,
        ];

        $accounting_group_laba = [
            'pendapatan' => 1,
            'pengeluaran' => 2,
            'penyusutanAmortisasi' => 3,
            'bungaPajak' => 4,
            'pendapatanPengeluaranLain' => 5,
        ];

        $results = $this->setResults($getDate[2], $getDate[0], $accounting_group);
        $laba = $this->getLaba($getDate[2], $getDate[0], $accounting_group_laba);

        return view('report.perubahanmodal')->with([
            'modal' => $results['modal'],
            'penguranganModal' => $results['penguranganModal'],
            'datepicker' => $getDate[1],
            'filter' => $getDate[2],
            'labaBerjalan' => $laba[1],
            'labaDitahan' => $laba[0],
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
            'modal' => 17,
            'penguranganModal' => 18,
        ];

        $accounting_group_laba = [
            'pendapatan' => 1,
            'pengeluaran' => 2,
            'penyusutanAmortisasi' => 3,
            'bungaPajak' => 4,
            'pendapatanPengeluaranLain' => 5,
        ];

        $results = $this->setResults($getDate[2], $getDate[0], $accounting_group);
        $laba = $this->getLaba($getDate[2], $getDate[0], $accounting_group_laba);


        return view('report.printformat.perubahanmodal')->with([
            'modal' => $results['modal'],
            'penguranganModal' => $results['penguranganModal'],
            'datepicker' => $getDate[1],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Perubahan Modal",
            'labaBerjalan' => $laba[1],
            'labaDitahan' => $laba[0],
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

            $summary = [];
            foreach ($transaction_accounts as $item) {
                $debit = $getTransaction->where('transaction_accounts_id', $item->id)->where('type', 'debit')->sum('amount');
                $kredit = $getTransaction->where('transaction_accounts_id', $item->id)->where('type', 'kredit')->sum('amount');

                $getHistory = $this->getHistory($filter, $item->id, $date);

                if (!empty($getHistory)) {
                    $saldo = $getHistory->saldo + ($debit - $kredit);
                } else {
                    $saldo = $debit - $kredit;
                }

                if ($saldo != 0) {
                    $summary[$item->id] = [
                        'name' => $item->name,
                        'saldo' => $saldo,
                        'penambahanSaldo' => ($debit - $kredit),
                        'saldoAwal' => $getHistory->saldo,
                    ];
                }
            }

            $results[$key] = $summary;
        }

        return $results;
    }

    public function getLaba($filter, $date, $accounting_group)
    {
        $labaBerjalan = 0;

        if ($filter == 'year') {
            $labaDitahan = HistoryReport::where('transaction_accounts_id', 9999)
                    ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?',  $date . '-01')
                    ->where('type', 'monthly')
                    ->select('saldo')
                    ->first();
        
        } else {
           $labaDitahan = HistoryReport::where('transaction_accounts_id', 9999)
                    ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
                    ->where('type', 'monthly')
                    ->select('saldo')
                    ->first();
        }

        if (empty($labaDitahan)) {
            $labaDitahan = 0;
        } else{
            $labaDitahan = $labaDitahan->saldo;
        }
        
        foreach ($accounting_group as $key => $value) {
            $getTransaction = $this->getTransaction($date, $filter, $value);

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
        $laba = [$labaDitahan, $labaBerjalan];
        
        return $laba;
    }
}
