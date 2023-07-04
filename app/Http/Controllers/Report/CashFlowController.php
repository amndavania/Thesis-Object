<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\HistoryReport;
use DateTime;
use Illuminate\Http\Request;
use PDF;


class CashFlowController extends Controller
{
    public function index(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $filter = $request->input('filter');

        $getDate = $this->getDate($datepicker, $filter);

        $accounting_group = [
            'arusKasMasuk' => 11,
            'arusKasKeluar' => 12,
            'penjualanAset' => 13,
            'pembelianAset' => 14,
            'penambahanDana' => 15,
            'penguranganDana' => 16,
        ];

        $results = $this->setResults($getDate[2], $getDate[0], $accounting_group);
        $saldoAwal = $this->getSaldoAwal($getDate[2], $getDate[0]);

        return view('report.cashflow')->with([
            'arusKasMasuk' => $results['arusKasMasuk'],
            'arusKasKeluar' => $results['arusKasKeluar'],
            'penjualanAset' => $results['penjualanAset'],
            'pembelianAset' => $results['pembelianAset'],
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
            'arusKasMasuk' => 11,
            'arusKasKeluar' => 12,
            'penjualanAset' => 13,
            'pembelianAset' => 14,
            'penambahanDana' => 15,
            'penguranganDana' => 16,
        ];

        $results = $this->setResults($getDate[2], $getDate[0], $accounting_group);
        $saldoAwal = $this->getSaldoAwal($getDate[2], $getDate[0]);

        return view('report.printformat.cashflow')->with([
            'arusKasMasuk' => $results['arusKasMasuk'],
            'arusKasKeluar' => $results['arusKasKeluar'],
            'penjualanAset' => $results['penjualanAset'],
            'pembelianAset' => $results['pembelianAset'],
            'penambahanDana' => $results['penambahanDana'],
            'penguranganDana' => $results['penguranganDana'],
            'datepicker' => $getDate[1],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Arus Kas",
            'saldoAwal' => $saldoAwal,
        ]);
    }

    public function getDate($datepicker, $filter)
    {
        
        if (empty($datepicker) || empty($filter)) {
            $date = date('Y-m');
            $dateTime = new DateTime($date);
            $formattedDate = $dateTime->format('F Y');
            $filter = 'month';
        }else {
            if ($filter == 'month') {
                $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
                $formattedDate = $parsedDate->format('F Y');
                $date = $parsedDate->format('Y-m');
            } elseif ($filter == 'year') {
                $parsedDate = \DateTime::createFromFormat('Y', $datepicker);
                $formattedDate = $parsedDate->format('Y');
                $date = $parsedDate->format('Y');
            }
        }

        return [$date, $formattedDate, $filter];
    }

    public function getTransaction($date, $filter, $accounting_group_id)
    {

        $transactions = Transaction::whereHas('transactionaccount.accountinggroup', function ($query) use ($accounting_group_id) {
            $query->where('accounting_groups.id', $accounting_group_id);
        })->when($filter == 'month', function ($query) use ($date) {
            $query->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date);
        })->when($filter == 'year', function ($query) use ($date) {
            $query->whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $date);
        })->get();
        
        return $transactions;
    }

    public function getHistory($filter, $transaction_account, $date)
    {
        if ($filter == 'year') {
            $history = HistoryReport::where('transaction_accounts_id', $transaction_account)
                    ->whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $date)
                    ->where('type', 'annual')->first();
        } else {
            $history = HistoryReport::where('transaction_accounts_id', $transaction_account)
                    ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
                    ->where('type', 'monthly')->first();
        }

        return $history;
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
                    $saldo = $getHistory->saldo + ($debit - $kredit);
                } else {
                    $saldo = $debit - $kredit;
                }

                $summary[$item->id] = [
                    'name' => $item->name,
                    'saldo' => $saldo
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