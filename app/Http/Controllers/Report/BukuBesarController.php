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

        if (empty($search_account) && empty($datepicker)) {
            $search_account = 1;
            $date = date('Y-m');
        }elseif(empty($search_account)) {
            $search_account = 1;
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $date = $parsedDate->format('Y-m');
        }elseif(empty($datepicker)) {
            $date = date('Y-m');
        }else{
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $date = $parsedDate->format('Y-m');
        }

        $data = Transaction::where('transaction_accounts_id', $search_account)
                    ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$date])
                    ->paginate(20);
        $dateTime = new DateTime($date);
        $formattedDate = $dateTime->format('F Y');
        $account = TransactionAccount::find($search_account);

        return view('report.bukubesar')->with([
            'data' => $data,
            'selects' => $select,
            'account' => $account->name,
            'datepicker' => $formattedDate,
        ]);
    }

    public function export()
    {
        $data = TransactionAccount::all();
        $pdf = PDF::loadView('report.printformat.bukubesar', compact('data'));
        $pdf->setOption('enable-local-file-access', true);
        Session::flash('title', 'Laporan Buku Besar');
        return $pdf->stream('Laporan Buku Besar.pdf');

    }
}
