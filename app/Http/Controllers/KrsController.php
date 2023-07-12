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
            'bimbinganstudi' => BimbinganStudy::latest()->paginate(20)
        ]);
    }

    public function export(Request $request)
    {
        $bimbinganstudi = BimbinganStudy::where('id', $request->id)->first();
        $student = Student::where('id', $bimbinganstudi->students_id)->first();

        if ($bimbinganstudi->semester == "GASAL") {
            $semesterStudent = (($bimbinganstudi->year - $student->force) * 2) + 1;
        } elseif ($bimbinganstudi->semester == "GENAP") {
            $semesterStudent = (($bimbinganstudi->year - $student->force) * 2);
        }

        return view('report.printformat.krs')->with([
            'bimbinganstudi' => $bimbinganstudi,
            'student' => $student,
            'semester' => $semesterStudent,
            'title' => "Lembar Bimbingan Studi",
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
        ]);
    }
}
