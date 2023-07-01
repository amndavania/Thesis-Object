<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use DateTime;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use PDF;
use Spatie\Browsershot\Browsershot;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $filter = $request->input('filter');
        $getData = $this->getData($datepicker, $filter);   
        $perPage = $request->input('per_page', 30);    

        return view('report.jurnal')->with([
            'data' => $getData[0],
            'datepicker' => $getData[1],
            'filter' => $filter
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
        

        return view('report.printformat.jurnal')->with([
            'data' => $getData[0],
            'datepicker' => $getData[1],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Jurnal"
        ]);
    }

    public function getData($datepicker, $filter)
    {
        if (empty($datepicker) || empty($filter)) {
            $date = date('Y-m');
            $dateTime = new DateTime($date);
            $formattedDate = $dateTime->format('F Y');
            $transaction = Transaction::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)->paginate(20);
        }else {
            if ($filter == 'month') {
                $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
                $formattedDate = $parsedDate->format('F Y');
                $date = $parsedDate->format('Y-m');
                $transaction = Transaction::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date)->paginate(20);
            } elseif ($filter == 'year') {
                $parsedDate = \DateTime::createFromFormat('Y', $datepicker);
                $formattedDate = $parsedDate->format('Y');
                $date = $parsedDate->format('Y');
                $transaction = Transaction::whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $date)->paginate(20);
            }
        }

        return [$transaction, $formattedDate];
    }
}
