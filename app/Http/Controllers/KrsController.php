<?php

namespace App\Http\Controllers;

use App\Models\BimbinganStudy;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KrsController extends Controller
{
    public function index():View
    {
        //
        return view('krs.krs')->with([
            'bimbinganstudi' => BimbinganStudy::paginate(20)
        ]);
    }

    public function export(Request $request)
    {
        $bimbinganstudi = BimbinganStudy::where('id', $request->id)->first();
        $student = BimbinganStudy::where('id', $bimbinganstudi->students_id)->first();

        return view('report.printformat.krs')->with([
            'bimbinganstudi' => $bimbinganstudi,
            'student' => $student,
            'title' => "Lembar Bimbingan Studi"
        ]);
    }
}
