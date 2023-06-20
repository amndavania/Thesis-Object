<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\TransactionAccount;
use DateTime;
use Illuminate\Http\Request;
use PDF;


class CashFlowController extends Controller
{
    public function index(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $getDate = $this->getDate($datepicker);
        $getData = $this->getData($getDate[0]);

        return view('report.cashflow')->with([
            'arusKasMasuk' => $getData[0],
            'arusKasKeluar' => $getData[1],
            'penjualanAset' => $getData[2],
            'pembelianAset' => $getData[3],
            'penambahanDana' => $getData[4],
            'penguranganDana' => $getData[5],
            'datepicker' => $getDate[1],
        ]);
    }

    public function export(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $dateTime = DateTime::createFromFormat('F Y', $datepicker);
        $date = $dateTime->format('m-Y');

        $getDate = $this->getDate($date);
        $getData = $this->getData($getDate[0]);

        return view('report.printformat.cashflow')->with([
            'arusKasMasuk' => $getData[0],
            'arusKasKeluar' => $getData[1],
            'penjualanAset' => $getData[2],
            'pembelianAset' => $getData[3],
            'penambahanDana' => $getData[4],
            'penguranganDana' => $getData[5],
            'datepicker' => $getDate[1],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Cash FLow"
        ]);

    }

    public function getDate($datepicker)
    {
        
        if (empty($datepicker)) {
            $date = date('Y-m');
            $dateTime = new DateTime($date);
            $formattedDate = $dateTime->format('F Y');
        }else {
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $formattedDate = $parsedDate->format('F Y');
            $date = $parsedDate->format('Y-m');
        }

        return [$date, $formattedDate];
    }

    public function getData($date)
    {

        $arusKasMasuk = TransactionAccount::where('accounting_group_id', 11)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();
        $arusKasKeluar = TransactionAccount::where('accounting_group_id', 12)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();
        $penjualanAset = TransactionAccount::where('accounting_group_id', 13)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();
        $pembelianAset = TransactionAccount::where('accounting_group_id', 14)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();
        $penambahanDana = TransactionAccount::where('accounting_group_id', 15)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();
        $penguranganDana = TransactionAccount::where('accounting_group_id', 16)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();

        return [$arusKasMasuk, $arusKasKeluar, $penjualanAset, $pembelianAset, $penambahanDana, $penguranganDana];
    }
}
