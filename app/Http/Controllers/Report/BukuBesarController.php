<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\TransactionAccount;
use PDF;


class BukuBesarController extends Controller
{
    public function index()
    {
        return view('report.bukubesar')->with([
            'data' => TransactionAccount::get(),
        ]);
    }

    public function downloadbukubesar()
    {
        $data = TransactionAccount::get();
        $content = PDF::loadView('report.printformat.bukubesar', compact('data'));
        $fileName = 'laporan buku besar.pdf';
        
        // $pdf = PDF::loadHtml($content);
    
        return $content->stream();

    }
}
