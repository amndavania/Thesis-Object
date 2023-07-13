<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UktController;
use App\Models\BimbinganStudy;
use App\Models\ExamCard;
use App\Models\Student;
use App\Models\Ukt;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;    

class CekPembayaranController extends Controller
{
    public function index()
    {
        return view('cek_detail_payment.form');
    }
    public function data(Request $request)
    {
        $uktController = new UktController;

        $student_id = $request->input('students_id');
        $payment_id = $request->input('id');
        $dispensasi = $request->input('dispensasi');

        if (!empty($payment_id) && !empty($dispensasi)) {
            $payment = Ukt::where('id', $payment_id)->first();
            $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();

            if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") {
                $payment->keterangan = "UTS";
                $payment->exam_uts_id = $uktController->createExamCard($student_id, "UTS", $payment->semester, $payment->year);
            } elseif ($dispensasi == "Menunggu Dispensasi UAS" && $bimbinganStudy->status == "Aktif") {
                $payment->keterangan = "UAS";
                $payment->exam_uas_id = $uktController->createExamCard($student_id, "UAS", $payment->semester, $payment->year);
            } elseif ($dispensasi == "Menunggu Dispensasi KRS") {
                $payment->keterangan = "KRS";
                $payment->lbs_id = $uktController->createBimbinganStudy($student_id, $payment->year, $payment->semester );
            }
            $payment->save();

        }

        if (empty($student_id)) {
            $student_first = Student::first();
            if ($student_first) {
                $student_id = $student_first->id;
            }
        }

        $student = Student::where('nim', $request['nim'])->first();

        if (!empty($student) && strcasecmp($student->name, $request['name']) === 0) {
            $isValid = true;
        } else {
            $isValid = false;
            $student = [];
        }

     
        if (!empty($student)) {
            return view('cek_detail_payment.data')->with([
                'ukt' => Ukt::where('students_id', $student->id)->latest()->get(),
                'students' => Student::select('name', 'id', 'nim')->get(),
                'choice' => $student,
                'isValid' => $isValid,
            ]);
        } else{
            return view('cek_detail_payment.data')->with([
                'ukt' => Ukt::where('students_id', 0)->get(),
                'students' => Student::select('name', 'id', 'nim')->latest()->get(),
                'choice' => $student,
                'isValid' => $isValid,
            ]);
        }

        
    }

    public function export(Request $request)
    {
        $ukt = Ukt::where('students_id', $request->student)->get();
        $student = Student::where('id', $request->student)->first();

        $totalUkt = $ukt->sum('amount');

        return view('report.printformat.pembayaran')->with([
            'ukt' => $ukt,
            'name' => $student->name,
            'nim' => $student->nim,
            'totalUkt' => $totalUkt,
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Pembayaran Mahasiswa"
        ]);

    }

    public function exportLBS(Request $request)
    {
        $bimbinganstudi = BimbinganStudy::where('id', $request->id)->first();
        $student = Student::where('id', $bimbinganstudi->students_id)->first();

        if ($bimbinganstudi->semester == "GASAL") {
            $semesterStudent = (($bimbinganstudi->year - $student->force) * 2) + 1;
        } elseif ($bimbinganstudi->semester == "GENAP") {
            $semesterStudent = (($bimbinganstudi->year - $student->force) * 2) + 2;
        }

        return view('report.printformat.krs')->with([
            'bimbinganstudi' => $bimbinganstudi,
            'student' => $student,
            'semester' => $semesterStudent,
            'title' => "Lembar Bimbingan Studi",
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
        ]);
    }

    public function lihatKartu(Request $request):View
    {
        $card = ExamCard::where('id', $request->id)->first();

        $student = Student::where('id', $card->students_id)->first();

        return view('report.printformat.examcard')->with([
            'examcard' => $card,
            'student' => $student,
        ]);
    }
}
