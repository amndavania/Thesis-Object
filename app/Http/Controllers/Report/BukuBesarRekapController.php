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
        $filter = $request->input('filter');

        $getData = $this->getData($datepicker, $filter);

        if ($filter == 'year') {
            $data = TransactionAccount::whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $getData[1])->get();
        } else {
            $data = TransactionAccount::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $getData[1])->get();
        }


        return view('report.bukubesarrekap')->with([
            'data' => $data,
            'datepicker' => $getData[2],
            'filter' => $filter,
        ]);
    }

    public function export(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $filter = $request->input('filter');

        if ($filter == 'year') {
            $dateTime = DateTime::createFromFormat('Y', $datepicker);
            $date = $dateTime->format('Y');
        } else {
            $dateTime = DateTime::createFromFormat('F Y', $datepicker);
            $date = $dateTime->format('m-Y');
        }

        $getData = $this->getData($date, $filter);
        
        if ($filter == 'year') {
            $data = TransactionAccount::whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $getData[1])->get();
        } else {
            $data = TransactionAccount::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $getData[1])->get();
        }

        return view('report.printformat.bukubesarrekap')->with([
            'data' => $data,
            'datepicker' => $getData[2],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Buku Besar",
        ]);

    }

    public function getData($datepicker, $filter)
    {
        if (empty($search_account)){
            $account = TransactionAccount::first();
            $search_account = !empty($account) ? $account->id : 0;
        }
        $date = date('Y-m');
        $formattedDate = date('F Y');

        if (!empty($datepicker)) {
            if ($filter == 'month') {
                $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
                $date = $parsedDate->format('Y-m');
                $formattedDate = $parsedDate->format('F Y');
            } elseif ($filter == 'year') {
                $parsedDate = \DateTime::createFromFormat('Y', $datepicker);
                $date = $parsedDate->format('Y');
                $formattedDate = $parsedDate->format('Y');
            }
        }

        return [$search_account, $date, $formattedDate];
    }
}
