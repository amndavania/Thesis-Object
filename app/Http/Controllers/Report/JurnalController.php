<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use DateTime;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PDF;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $getData = $this->getData($datepicker);
        $transaction = Transaction::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $getData[0])->paginate(20);

        return view('report.jurnal')->with([
            'data' => $transaction,
            'datepicker' => $getData[1],
        ]);
    }

    public function export(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $dateTime = DateTime::createFromFormat('F Y', $datepicker);
        $date = $dateTime->format('m-Y');

        $getData = $this->getData($date);
        $transaction = Transaction::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $getData[0])->get();

        $pdf = PDF::loadView('report.printformat.jurnal', [
            'data' => $transaction,
            'datepicker' => $getData[1],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
        ]);
        $pdf->setOption('enable-local-file-access', true);
        Session::flash('title', 'Jurnal Umum');
        return $pdf->stream('Jurnal Umum.pdf');
    }

    public function getData($datepicker)
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
