<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\TransactionAccount;
use PDF;


class LabaRugiController extends Controller
{
    public function index()
    {
        $dataA = TransactionAccount::where('accounting_group_id', 1)->get();
        $dataB = TransactionAccount::where('accounting_group_id', 2)->get();
        $dataC = TransactionAccount::where('accounting_group_id', 3)->get();
        $dataD = TransactionAccount::where('accounting_group_id', 4)->get();
        $dataE = TransactionAccount::where('accounting_group_id', 5)->get();
        $dataF = TransactionAccount::where('accounting_group_id', 6)->get();

        return view('report.labarugi')->with([
            'dataA' => $dataA,
            'dataB' => $dataB,
            'dataC' => $dataC,
            'dataD' => $dataD,
            'dataE' => $dataE,
            'dataF' => $dataF,
        ]);
    }

    public function export()
    {
        $data = TransactionAccount::get();
        $pdf = PDF::loadView('report.printformat.labarugi', compact('data'));
        $pdf->setOption('enable-local-file-access', true);
        Session::flash('title', 'Laporan Laba Rugi');
        return $pdf->stream('Laporan Laba Rugi.pdf');

    }
}
