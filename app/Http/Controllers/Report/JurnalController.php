<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use PDF;


class JurnalController extends Controller
{
    public function index()
    {
        return view('report.printformat.jurnal')->with([
            'data' => Transaction::get(),
        ]);
    }

    public function downloadJurnal()
    {
        $data = Transaction::get();
        $content = PDF::loadView('report.printformat.jurnal', compact('data'));
        $fileName = 'jurnal.pdf';
        
        // $pdf = PDF::loadHtml($content);
    
        return $content->stream();

    }
}
