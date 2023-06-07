<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use App\Models\TransactionAccount;
use Illuminate\Http\Request;
use PDF;


class BukuBesarController extends Controller
{
    public function index()
    {
        return view('report.bukubesar')->with([
            'data' => TransactionAccount::get(),
            'selects' => TransactionAccount::get()
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

    public function search(Request $request)
    {
        $search_account = $request->input('search_account');
        $datepicker = $request->input('datepicker');

        $query = Transaction::query();

        if (!empty($search_account)) {
            $query->where('transaction_accounts_id', $search_account);
        }

        if (!empty($datepicker)) {
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $monthYear = $parsedDate->format('Y-m');
            $query->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$monthYear]);
            // date("m-Y", strtotime('created_at'))
        }

        $results = $query->get();

        return view('report.bukubesar')->with([
            'data' => $results,
            'selects' => TransactionAccount::get()
        ]);
    }
}
