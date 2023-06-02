<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\TransactionAccount;
use PDF;


class CashFlowController extends Controller
{
    public function index()
    {
        $dataA = TransactionAccount::where('accounting_group_id', 1)->get();
        $dataB = TransactionAccount::where('accounting_group_id', 2)->get();
        $dataC = TransactionAccount::where('accounting_group_id', 3)->get();
        $dataD = TransactionAccount::where('accounting_group_id', 4)->get();
        $dataE = TransactionAccount::where('accounting_group_id', 5)->get();
        $dataF = TransactionAccount::where('accounting_group_id', 6)->get();
        
        return view('report.cashflow')->with([
            'dataA' => $dataA,
            'dataB' => $dataB,
            'dataC' => $dataC,
            'dataD' => $dataD,
            'dataE' => $dataE,
            'dataF' => $dataF,
        ]);
    }

    public function downloadbukubesar()
    {
        $data = TransactionAccount::get();
        $content = PDF::loadView('report.printformat.cashflow', compact('data'));
        $fileName = 'laporan buku besar.pdf';
        
        // $pdf = PDF::loadHtml($content);
    
        return $content->stream();

    }
}
