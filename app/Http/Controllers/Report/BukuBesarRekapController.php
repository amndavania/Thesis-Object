<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\HistoryReport;
use App\Models\TransactionAccount;
use Illuminate\Support\Facades\Session;
use DateTime;
use Illuminate\Http\Request;
use PDF;

class BukuBesarRekapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $datepicker = $request->input('datepicker');

        $currentMonthYear = date('m-Y');


        if ($datepicker === $currentMonthYear) {
            // Ambil data dari tabel TransactionAccount
            $data = TransactionAccount::whereRaw('DATE_FORMAT(created_at, "%m-%Y") = ?', $datepicker)->get();
        } else {
            $data = HistoryReport::whereRaw('DATE_FORMAT(created_at, "%m-%Y") = ?', $datepicker)->get();
        }

        return view('report.bukubesarrekap')->with([
            'data' => $data,
            'datepicker' => $datepicker,
        ]);
    }

    public function export(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $filter = $request->input('filter');

        $currentMonthYear = date('Y-m');

        if ($datepicker === $currentMonthYear) {
            // Ambil data dari tabel TransactionAccount
            if ($filter == 'year') {
                $data = TransactionAccount::whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $datepicker)->get();
            } else {
                $data = TransactionAccount::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->get();
            }
        } else {
            // Ambil data dari tabel HistoryReport
            if ($filter == 'year') {
                $data = HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $datepicker)->get();
            } else {
                $data = HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->get();
            }
        }

        return view('report.printformat.bukubesarrekap')->with([
            'data' => $data,
            'datepicker' => $datepicker,
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Buku Besar",
        ]);

    }
}
