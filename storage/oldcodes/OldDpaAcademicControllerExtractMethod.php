<?php

namespace App\Http\Controllers;

use App\Models\Dpa;
use App\Models\Student;
use App\Models\Ukt;
use App\Models\ExamCard;
use App\Models\BimbinganStudy;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

//INI ADALAH CLASS UNTUK HANDLE MAHASISWA & BIMBINGAN STUDI

class DpaAcademicController extends Controller
{
    public function getMahasiswa(Request $request): View
    {
        $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
        $tahunAjaran = $request->year ?? date('Y');
        $semester = $request->semester ?? 'GASAL';
        $students = Student::where('dpa_id', $dpa_id)->get();

        if ($request->student_id) {
            $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);
        }

        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

        return view('dpa.daftarmahasiswa')->with([
            'data' => $data,
            'tahunAjaran' => [$tahunAjaran, $semester],
            'dpa' => Dpa::find($dpa_id),
        ]);
    }

    public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester) //S15
    {
        $uktController = new UktController; //S16

        if (empty($id)) { //S17
            BimbinganStudy::create([ //S18
                'students_id' => $student_id, //S19
                'year' => $tahunAjaran, //S20
                'semester' => $semester, //S21
                'status' => $status //S22
            ]);
        } else {
            $bimbinganStudy = BimbinganStudy::find($id); //S23
            $bimbinganStudy->status = $status; //S24
            $bimbinganStudy->save(); //S25
        }

        $payment = Ukt::where('lbs_id', $id)->first(); //S26
        if ($payment) { //S27
            $uts_id = $payment->exam_uts_id; //S28
            $uas_id = $payment->exam_uas_id; //S29

            if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) { //S30
                $payment->exam_uts_id = $uktController->createExamCard($payment->students_id, "UTS", $payment->semester, $payment->year); //S31
            } elseif ($status == "Tunda") { //S32
                ExamCard::destroy([$uts_id]); //S33 //S34
                $payment->exam_uts_id = null; //S35
            }

            if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) { //S36
                $payment->exam_uts_id = $uktController->createExamCard($payment->students_id, "UTS", $payment->semester, $payment->year); //S37
                $payment->exam_uas_id = $uktController->createExamCard($payment->students_id, "UAS", $payment->semester, $payment->year); //S38
            } elseif ($status == "Tunda") { //S39
                ExamCard::destroy([$uts_id, $uas_id]); //S40 //S41 //S42 
                $payment->exam_uts_id = $payment->exam_uas_id = null; //S43
            }

            $payment->save(); //S44
        } elseif ($status == "Tidak Aktif" && $id) { //S45
            BimbinganStudy::destroy($id); //S46
        }
    }

    public function getBimbinganStudi($students, $tahunAjaran, $semester)
    {
        $data = [];

        foreach ($students as $item) {
            $wisuda = Ukt::where('students_id', $item->id)->where('type', "WISUDA")->first();
            $semesterStudent = (($tahunAjaran - $item->force) * 2) + ($semester === "GASAL" ? 1 : 2);

            if (!$wisuda || $tahunAjaran <= $wisuda->year) {
                $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)
                    ->where('year', $tahunAjaran)
                    ->where('semester', $semester)
                    ->first();

                $data[$item->id] = [
                    'id' => $item->id,
                    'nim' => $item->nim,
                    'name' => $item->name,
                    'semester' => $semesterStudent,
                    'lbs_id' => $bimbinganStudy->id ?? null,
                    'status' => $bimbinganStudy->status ?? "Tidak Aktif"
                ];
            }
        }
        return $data;
    }

    public function export(Request $request)
    {
        $dpa_id = $request->dpa_id;
        $tahunAjaran = $request->year;
        $semester = $request->semester;

        if (empty($tahunAjaran) || empty($semester)) {
            $tahunAjaran = date('Y');
            $semester = "GASAL";
        }

        if (empty($dpa_id)) {
            if (Auth::user()->role == "DPA") {
                $user_id = Auth::user()->id;
                $dpa = Dpa::where('user_id', $user_id)->first();
                $dpa_id = $dpa->id;
            } else {
                $dpa = Dpa::first();
                $dpa_id = $dpa->id;
            }
        }

        $dpa = Dpa::where('id', $dpa_id)->first();
        $students = Student::where('dpa_id', $dpa_id)->get();

        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

        return view('report.printformat.daftarmahasiswa')->with([
            'data' => $data,
            'tahunAjaran' => [$tahunAjaran, $semester],
            'dpa' => $dpa,
            'title' => "Lembar Bimbingan Studi",
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
        ]);
    }
}
