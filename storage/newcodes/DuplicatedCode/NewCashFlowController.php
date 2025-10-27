<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\HistoryReport;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Report\ReportHelper;

class CashFlowController extends Controller
{
    use ReportHelper;

    public function index(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $filter = $request->input('filter');

        $getDate = $this->getDate($datepicker, $filter);

        $accounting_group = [
            'arusKas' => 11,
            'aset' => 12,
            'penambahanDana' => 13,
            'penguranganDana' => 14,
        ];

        $results = $this->setResults($getDate[2], $getDate[0], $accounting_group);
        $saldoAwal = $this->getSaldoAwal($getDate[2], $getDate[0]);

        return view('report.cashflow')->with([
            'arusKas' => $results['arusKas'],
            'aset' => $results['aset'],
            'penambahanDana' => $results['penambahanDana'],
            'penguranganDana' => $results['penguranganDana'],
            'datepicker' => $getDate[1],
            'filter' => $filter,
            'saldoAwal' => $saldoAwal,
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
            'arusKas' => 11,
            'aset' => 12,
            'penambahanDana' => 13,
            'penguranganDana' => 14,
        ];

        $results = $this->setResults($getDate[2], $getDate[0], $accounting_group);
        $saldoAwal = $this->getSaldoAwal($getDate[2], $getDate[0]);

        return view('report.printformat.cashflow')->with([
            'arusKas' => $results['arusKas'],
            'aset' => $results['aset'],
            
            'penambahanDana' => $results['penambahanDana'],
            'penguranganDana' => $results['penguranganDana'],
            'datepicker' => $getDate[1],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Arus Kas",
            'saldoAwal' => $saldoAwal,
        ]);
    }

    public function setResults($filter, $date, $accounting_group)
    {
        $results = [];

        foreach ($accounting_group as $key => $value) {
            $getTransaction = $this->getTransaction($date, $filter, $value);
            $transaction_accounts = TransactionAccount::whereHas('transaction', function ($query) use ($getTransaction) {
                $transactionAccountsIds = $getTransaction->pluck('transaction_accounts_id')->toArray();
                $query->whereIn('transaction_accounts_id', $transactionAccountsIds);
            })->get();

            $summary = [];
            foreach ($transaction_accounts as $item) {
                $debit = $getTransaction->where('transaction_accounts_id', $item->id)->where('type', 'debit')->sum('amount');
                $kredit = $getTransaction->where('transaction_accounts_id', $item->id)->where('type', 'kredit')->sum('amount');

                $getHistory = $this->getHistory($filter, $item->id, $date);

                if (!empty($getHistory)) {
                    if ($item->lajurLaporan == 'labaRugi') {
                        $saldo = $getHistory->saldo + ($kredit - $debit);
                    } else {
                        $saldo = $getHistory->saldo + ($debit - $kredit);
                    }
                } else {
                    if ($item->lajurLaporan == 'labaRugi') {
                        $saldo = $kredit - $debit;
                    } else {
                        $saldo =  $debit - $kredit;
                    }
                }

                $summary[$item->id] = [
                    'name' => $item->name,
                    'saldo' => $saldo,
                    'debit' => $debit,
                    'kredit' => $kredit,
                ];
            }

            $results[$key] = $summary;
        }

        return $results;
    }

    public function getSaldoAwal($filter, $date){
        $saldoAwal = HistoryReport::when($filter == 'month', function ($query) use ($date) {
            $query->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date);
        })->when($filter == 'year', function ($query) use ($date) {
            $query->where('type', 'annual')->whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $date);
        })->sum('saldo');
        
        return $saldoAwal;
    }
}