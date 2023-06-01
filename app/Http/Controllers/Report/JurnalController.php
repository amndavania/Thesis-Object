<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use PDF;


class JurnalController extends Controller
{
    public function index()
    {
        return view('report.jurnal')->with([
            'transaction' => Transaction::all(),
        ]);
    }

    public function export()
    {
        $transaction = Transaction::all();
        $pdf = PDF::loadView('report.printformat.jurnal', compact('transaction'));
        $pdf->setOption('enable-local-file-access', true);
        // $pdf->setOptions(['margin_top' => 0, 'margin_bottom' => 0, 'margin_left' => 0, 'margin_right' => 0]);
        return $pdf->stream('jurnal.pdf');
    }
}
