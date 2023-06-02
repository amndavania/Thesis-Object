<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\TransactionAccount;
use PDF;


class BukuBesarController extends Controller
{
    public function index()
    {
        return view('report.bukubesar')->with([
            'data' => TransactionAccount::get(),
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
