<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
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

        if (empty($datepicker)) {
            return view('report.jurnal')->with([
                'data' => Transaction::paginate(20),
            ]);
        }else {
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $formattedDate = $parsedDate->format('F Y');
            $monthYear = $parsedDate->format('Y-m');
            return view('report.jurnal')->with([
                'data' => Transaction::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$monthYear])
                     ->paginate(20), 
                'datepicker' => $formattedDate,
            ]);
        }
    }

    public function export()
    {
        $transaction = Transaction::all();
        $pdf = PDF::loadView('report.printformat.jurnal', compact('transaction'));
        $pdf->setOption('enable-local-file-access', true);
        Session::flash('title', 'Jurnal Umum');
        return $pdf->stream('Jurnal Umum.pdf');
    }
}
