<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\TransactionAccount;
use DateTime;
use Illuminate\Http\Request;
use PDF;


class NeracaController extends Controller
{
    public function index(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $getDate = $this->getDate($datepicker);
        $getData = $this->getData($getDate[0]);

        return view('report.neraca')->with([
            'aktivaLancar' => $getData[0],
            'aktivaTetap' => $getData[1],
            'hutangLancar' => $getData[2],
            'hutangJangkaPanjang' => $getData[3],
            'modal' => $getData[4],
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

        return view('report.printformat.neraca')->with([
            'aktivaLancar' => $getData[0],
            'aktivaTetap' => $getData[1],
            'hutangLancar' => $getData[2],
            'hutangJangkaPanjang' => $getData[3],
            'modal' => $getData[4],
            'datepicker' => $getDate[1],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Neraca"
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

        $aktivaLancar = TransactionAccount::where('accounting_group_id', 6)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();
        $aktivaTetap = TransactionAccount::where('accounting_group_id', 7)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();
        $hutangLancar = TransactionAccount::where('accounting_group_id', 8)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();
        $hutangJangkaPanjang = TransactionAccount::where('accounting_group_id', 9)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();
        $modal = TransactionAccount::where('accounting_group_id', 10)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)
            ->get();

        return [$aktivaLancar, $aktivaTetap, $hutangLancar, $hutangJangkaPanjang, $modal];
    }

}
