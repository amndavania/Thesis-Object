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

class BukuBesarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $select = TransactionAccount::pluck('name', 'id');
        $search_account = $request->input('search_account');
        $datepicker = $request->input('datepicker');
        $filter = $request->input('filter');

        $getData = $this->getData($search_account, $datepicker, $filter);

        if ($filter == 'year') {
            $data = Transaction::where('transaction_accounts_id', $getData[0])
                    ->whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $getData[1])->get();
            $history = HistoryReport::where('transaction_accounts_id', $getData[0])
                    ->whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $getData[1])
                    ->where('type', 'annual')->first();
        } else {
            $data = Transaction::where('transaction_accounts_id', $getData[0])
                    ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $getData[1])->get();
            $history = HistoryReport::where('transaction_accounts_id', $getData[0])
                    ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $getData[1])
                    ->where('type', 'monthly')->first();
        }

        $account = TransactionAccount::find($getData[0]);

        return view('report.bukubesar')->with([
            'data' => $data,
            'selects' => $select,
            'account' => $account,
            'datepicker' => $getData[2],
            'filter' => $filter,
            'history' => $history
        ]);
    }

    public function export(Request $request)
    {
        $search_account = $request->input('search_account');
        $datepicker = $request->input('datepicker');
        $filter = $request->input('filter');

        if ($filter == 'year') {
            $dateTime = DateTime::createFromFormat('Y', $datepicker);
            $date = $dateTime->format('Y');
        } else {
            $dateTime = DateTime::createFromFormat('F Y', $datepicker);
            $date = $dateTime->format('m-Y');
        }

        $getData = $this->getData($search_account, $date, $filter);
        
        if ($filter == 'year') {
            $data = Transaction::where('transaction_accounts_id', $getData[0])
                    ->whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $getData[1])->get();
            $history = HistoryReport::where('transaction_accounts_id', $getData[0])
                    ->whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $getData[1])
                    ->where('type', 'annual')->first();
        } else {
            $data = Transaction::where('transaction_accounts_id', $getData[0])
                    ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $getData[1])->get();
            $history = HistoryReport::where('transaction_accounts_id', $getData[0])
                    ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $getData[1])
                    ->where('type', 'monthly')->first();
        }

        $account = TransactionAccount::find($getData[0]);

        return view('report.printformat.bukubesar')->with([
            'data' => $data,
            'datepicker' => $getData[2],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'account' => $account,
            'title' => "Laporan Buku Besar",
            'history' => $history
        ]);

    }

    public function getData($search_account, $datepicker, $filter)
    {
        if (empty($search_account)){
            $account = TransactionAccount::first();
            $search_account = !empty($account) ? $account->id : 0;
        }
        $date = date('Y-m');
        $formattedDate = date('F Y');

        if (!empty($datepicker)) {
            if ($filter == 'month') {
                $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
                $date = $parsedDate->format('Y-m');
                $formattedDate = $parsedDate->format('F Y');
            } elseif ($filter == 'year') {
                $parsedDate = \DateTime::createFromFormat('Y', $datepicker);
                $date = $parsedDate->format('Y');
                $formattedDate = $parsedDate->format('Y');
            }
        }

        return [$search_account, $date, $formattedDate];
    }
}
