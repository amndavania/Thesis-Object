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
        $getDate = $this->getDate($datepicker);
        $transaction = Transaction::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $getDate[0])->paginate(20);
        $transactions = Transaction::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $getDate[0])->get();

        $totalDebit = 0;
        $totalKredit = 0;
        foreach ($transactions as $row){
            if ($row->type == 'debit') {
                $totalDebit += $row->amount;
            } elseif ($row->type == 'kredit') {
                $totalKredit += $row->amount;
            }
        };

        return view('report.jurnal')->with([
            'data' => $transaction,
            'datepicker' => $getDate[1],
            'totalDebit' => $totalDebit,
            'totalKredit' => $totalKredit,
        ]);
    }

    public function export(Request $request)
{
    $datepicker = $request->input('datepicker');
    $dateTime = DateTime::createFromFormat('F Y', $datepicker);
    $date = $dateTime->format('m-Y');

    $getDate = $this->getDate($date);
    $transaction = Transaction::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $getDate[0])->get();

    return view('report.printformat.jurnal')->with([
        'data' => $transaction,
        'datepicker' => $getDate[1],
        'today' => date('d F Y', strtotime(date('Y-m-d'))),
        'title' => "Laporan Jurnal"
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
}
