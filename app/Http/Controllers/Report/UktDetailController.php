<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UktController;
use Illuminate\Support\Facades\Session;
use App\Models\Student;
use App\Models\Ukt;
use Illuminate\Http\Request;
use PDF;

class UktDetailController extends Controller
{
    public function index(Request $request)
    {
        $uktController = new UktController;

        $student_id = $request->input('students_id');
        $payment_id = $request->input('id');
        $dispensasi = $request->input('dispensasi');

        if (!empty($payment_id) && !empty($dispensasi)) {
            $payment = Ukt::where('id', $payment_id)->first();

            if ($dispensasi == "Menunggu Dispensasi UTS") {
                $payment->keterangan = "UTS";
                $payment->exam_uts_id = $uktController->createExamCard($student_id, "UTS", $payment->semester, $payment->year);
            } elseif ($dispensasi == "Menunggu Dispensasi UAS") {
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

        $student = Student::where('id', $student_id)->first();

        if (!empty($student)) {
            return view('detail_payment.ukt')->with([
                'ukt' => Ukt::where('students_id', $student->id)->get(),
                'students' => Student::select('name', 'id', 'nim')->get(),
                'choice' => $student,
            ]);
        } else{
            return view('detail_payment.ukt')->with([
                'ukt' => Ukt::where('students_id', 0)->get(),
                'students' => Student::select('name', 'id', 'nim')->get(),
                'choice' => $student,
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
}
