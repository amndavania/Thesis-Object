<?php

namespace App\Http\Controllers;

use App\Models\BimbinganStudy;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KrsController extends Controller
{
    use ExportsKrs;
    
    public function index():View
    {
        //
        return view('krs.krs')->with([
            'bimbinganstudi' => BimbinganStudy::latest()->paginate(20)
        ]);
    }

    public function export(Request $request) 
    {
            $data = $this->generateKrsData($request->id); 
            return view('report.printformat.krs')->with($data);
    }
}
