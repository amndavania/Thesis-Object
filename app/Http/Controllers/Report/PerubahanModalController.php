<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\HistoryReport;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use App\Models\TransactionAccount;
use DateTime;
use Illuminate\Http\Request;
use PDF;


class PerubahanModalController extends Controller
{
    public function index(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $filter = $request->input('filter');

        $getDate = $this->getDate($datepicker, $filter);

        $accounting_group = [
            'modaldiAwal' => 17,
            'penambahanModal' => 18,
            'penguranganModal' => 19,
        ];

        $results = $this->setResults($filter, $getDate[0], $accounting_group);

        return view('report.perubahanmodal')->with([
            'modaldiAwal' => $results['modaldiAwal'],
            'penambahanModal' => $results['penambahanModal'],
            'penguranganModal' => $results['penguranganModal'],
            'datepicker' => $getDate[1],
            'filter' => $filter,
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
            'modaldiAwal' => 17,
            'penambahanModal' => 18,
            'penguranganModal' => 19,
        ];

        $results = $this->setResults($filter, $getDate[0], $accounting_group);

        return view('report.printformat.perubahanmodal')->with([
            'modaldiAwal' => $results['modaldiAwal'],
            'penambahanModal' => $results['penambahanModal'],
            'penguranganModal' => $results['penguranganModal'],
            'datepicker' => $getDate[1],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Perubahan Modal"
        ]);

    }

    public function getDate($datepicker, $filter)
    {
        
        if (empty($datepicker) || empty($filter)) {
            $date = date('Y-m');
            $dateTime = new DateTime($date);
            $formattedDate = $dateTime->format('F Y');
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

        return [$date, $formattedDate];
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

                if (!empty($getHistory)) {
                    $saldo = $getHistory->saldo + ($debit - $kredit);
                } else {
                    $saldo = $debit - $kredit;
                }

                if ($saldo != 0) {
                    $summary[$item->id] = [
                        'name' => $item->name,
                        'saldo' => $saldo
                    ];
                }
            }

            $results[$key] = $summary;
        }

        return $results;
    }
}
