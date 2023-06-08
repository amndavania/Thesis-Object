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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_account = $request->input('search_account');
        $datepicker = $request->input('datepicker');

        if (empty($search_account) || empty($datepicker)) {
            return view('report.bukubesar')->with([
                'data' => Transaction::paginate(20),
                'selects' => TransactionAccount::pluck('name', 'id')
            ]);
        }else {
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $monthYear = $parsedDate->format('Y-m');
            return view('report.bukubesar')->with([
                'data' => Transaction::where('transaction_accounts_id', $search_account)
                     ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$monthYear])
                     ->paginate(20),
                'selects' => TransactionAccount::pluck('name', 'id')
            ]);
        }
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
