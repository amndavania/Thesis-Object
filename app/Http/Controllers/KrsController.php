<?php

namespace App\Http\Controllers;

use App\Models\BimbinganStudy;
use App\Models\Student;
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
        $student = Student::where('id', $bimbinganstudi->students_id)->first();

        // if ($bimbinganstudi->semester == "GASAL") {
        //     $semesterStudent = (($))
        // } elseif ($bimbinganstudi->semester == "GENAP") {
        //     # code...
        // }

        return view('report.printformat.krs')->with([
            'bimbinganstudi' => $bimbinganstudi,
            'student' => $student,
            'title' => "Lembar Bimbingan Studi"
        ]);
    }
}
