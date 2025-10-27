<?php

namespace App\Http\Controllers;

use App\Models\BimbinganStudy;
use App\Models\Student;

trait ExportsKrs
{

    public function generateKrsData($id)
    {
        $bimbinganstudi = BimbinganStudy::where('id', $id)->first();
        $student = Student::where('id', $bimbinganstudi->students_id)->first();

        if ($bimbinganstudi->semester == "GASAL") {
            $semesterStudent = (($bimbinganstudi->year - $student->force) * 2) + 1;
        } elseif ($bimbinganstudi->semester == "GENAP") {
            $semesterStudent = (($bimbinganstudi->year - $student->force) * 2) + 2;
        }

        return [
            'bimbinganstudi' => $bimbinganstudi,
            'student'        => $student,
            'semester'       => $semesterStudent,
            'title'          => "Lembar Bimbingan Studi",
            'today'          => date('d F Y'),
        ];
    }
}
