<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
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

        $getData = $this->getData($search_account, $datepicker);

        $data = Transaction::where('transaction_accounts_id', $getData[0])
                    ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $getData[1])
                    ->paginate(20);
        $account = TransactionAccount::find($getData[0]);

        return view('report.bukubesar')->with([
            'data' => $data,
            'selects' => $select,
            'account' => $account,
            'datepicker' => $getData[2],
        ]);
    }

    public function export(Request $request)
    {
        $search_account = $request->input('search_account');
        $datepicker = $request->input('datepicker');

        $dateTime = DateTime::createFromFormat('F Y', $datepicker);
        $date = $dateTime->format('m-Y');

        $getData = $this->getData($search_account, $date);
        
        $transaction = Transaction::where('transaction_accounts_id', $getData[0])
                    ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $getData[1])->get();
        $account = TransactionAccount::find($getData[0]);

        return view('report.printformat.bukubesar')->with([
            'data' => $transaction,
            'datepicker' => $getData[2],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'account' => $account,
            'title' => "Laporan Buku Besar"
        ]);

    }

    public function getData($search_account, $datepicker)
    {
        $account = TransactionAccount::first();
        if (empty($search_account) && empty($datepicker)) {
            $search_account = $account->id;
            $date = date('Y-m');
        }elseif(empty($search_account)) {
            $search_account = $account->id;
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $date = $parsedDate->format('Y-m');
        }elseif(empty($datepicker)) {
            $date = date('Y-m');
        }else{
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $date = $parsedDate->format('Y-m');
        }

        $dateTime = new DateTime($date);
        $formattedDate = $dateTime->format('F Y');

        return [$search_account, $date, $formattedDate];
    }
}
