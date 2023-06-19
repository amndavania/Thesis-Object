<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\TransactionAccount;
use DateTime;
use Illuminate\Http\Request;
use PDF;


class LabaRugiController extends Controller
{
    public function index(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $getDate = $this->getDate($datepicker);
        $getData = $this->getData($getDate[0]);

        return view('report.labarugi')->with([
            'dataA' => $getData[0],
            'dataB' => $getData[1],
            'dataC' => $getData[2],
            'dataD' => $getData[3],
            'dataE' => $getData[4],
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

        return view('report.printformat.labarugi')->with([
            'dataA' => $getData[0],
            'dataB' => $getData[1],
            'dataC' => $getData[2],
            'dataD' => $getData[3],
            'dataE' => $getData[4],
            'datepicker' => $getDate[1],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Laba Rugi"
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

    public function getData($date){
        $pendapatan = TransactionAccount::where('accounting_group_id', 1)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();
        $pengeluaran = TransactionAccount::where('accounting_group_id', 2)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();
        $penyusutanAmortisasi = TransactionAccount::where('accounting_group_id', 3)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();
        $bungaPajak = TransactionAccount::where('accounting_group_id', 4)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();
        $pendapatanPengeluaranLain = TransactionAccount::where('accounting_group_id', 5)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();

        return [$pendapatan, $pengeluaran, $penyusutanAmortisasi, $bungaPajak, $pendapatanPengeluaranLain];
    }
}
