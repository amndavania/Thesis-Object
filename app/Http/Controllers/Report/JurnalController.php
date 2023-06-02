<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
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
        Session::flash('title', 'Jurnal Umum');
        return $pdf->stream('Jurnal Umum.pdf');
    }
}
