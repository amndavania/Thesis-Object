<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\TransactionAccount;
use PDF;


class NeracaController extends Controller
{
    public function index()
    {
        $arusKasMasuk = TransactionAccount::where('accounting_group_id', 1)->get();
        $arusKasKeluar = TransactionAccount::where('accounting_group_id', 2)->get();
        $penjualanAset = TransactionAccount::where('accounting_group_id', 3)->get();
        $pembelianAset = TransactionAccount::where('accounting_group_id', 4)->get();
        $penambahanDana = TransactionAccount::where('accounting_group_id', 5)->get();
        $penguranganDana = TransactionAccount::where('accounting_group_id', 6)->get();

        return view('report.neraca')->with([
            'dataA' => $arusKasMasuk,
            'dataB' => $arusKasKeluar,
            'dataC' => $penjualanAset,
            'dataD' => $pembelianAset,
            'dataE' => $penambahanDana,
            'dataF' => $penguranganDana,
        ]);
    }

    public function export()
    {
        $data = TransactionAccount::get();
        $pdf = PDF::loadView('report.printformat.neraca', compact('data'));
        $pdf->setOption('enable-local-file-access', true);
        Session::flash('title', 'Laporan Neraca');
        return $pdf->stream('Laporan Neraca.pdf');

    }
}
