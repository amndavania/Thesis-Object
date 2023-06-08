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
        $pendapatan = TransactionAccount::where('accounting_group_id', 1)->get();
        $pengeluaran = TransactionAccount::where('accounting_group_id', 2)->get();
        $penyusutanAmortisasi = TransactionAccount::where('accounting_group_id', 3)->get();
        $bungaPajak = TransactionAccount::where('accounting_group_id', 4)->get();
        $pendapatanPengeluaranLain = TransactionAccount::where('accounting_group_id', 5)->get();

        return view('report.labarugi')->with([
            'dataA' => $pendapatan,
            'dataB' => $pengeluaran,
            'dataC' => $penyusutanAmortisasi,
            'dataD' => $bungaPajak,
            'dataE' => $pendapatanPengeluaranLain,
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
