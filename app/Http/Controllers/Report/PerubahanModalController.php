<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\TransactionAccount;
use DateTime;
use Illuminate\Http\Request;
use PDF;


class PerubahanModalController extends Controller
{
    public function index(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $getDate = $this->getDate($datepicker);
        $getData = $this->getData($getDate[0]);

        return view('report.perubahanmodal')->with([
            'modaldiAwal' => $getData[0],
            'penambahanModal' => $getData[1],
            'penguranganModal' => $getData[2],
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

        return view('report.printformat.perubahanmodal')->with([
            'modaldiAwal' => $getData[0],
            'penambahanModal' => $getData[1],
            'penguranganModal' => $getData[2],
            'datepicker' => $getDate[1],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Perubahan Modal"
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

        $modaldiAwal = TransactionAccount::whereHas('accountinggroup', function ($query) {
            $query->where('id', 17);
        })->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)->get();
        $penambahanModal = TransactionAccount::whereHas('accountinggroup', function ($query) {
            $query->where('id', 18);
        })->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)->get();
        $penguranganModal = TransactionAccount::whereHas('accountinggroup', function ($query) {
            $query->where('id', 19);
        })->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)->get();

        return [$modaldiAwal, $penambahanModal, $penguranganModal];
    }
}
