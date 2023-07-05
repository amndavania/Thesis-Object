<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UktController;
use App\Models\Student;
use App\Models\Ukt;
use Illuminate\Http\Request;    

class CekPembayaranController extends Controller
{
    public function index()
    {
        return view('cek_detail_payment.form');
    }
    public function data(Request $request)
    {
        // dd($request);

        $currentYear = date('Y');

        $student_id = $request->input('students_id');
        $payment_id = $request->input('id');
        $dispensasi = $request->input('dispensasi');

        if (!empty($payment_id) && !empty($dispensasi)) {
            $payment = Ukt::where('id', $payment_id)->first();

            if ($dispensasi == "Menunggu Dispensasi UTS") {
                $payment->keterangan = "UTS";
                $payment->exam_uts_id = UktController::createExamCard($student_id, "UTS", $payment->semester, $currentYear);
            } elseif ($dispensasi == "Menunggu Dispensasi UAS") {
                $payment->keterangan = "ALL";
                $payment->exam_uas_id = UktController::createExamCard($student_id, "UAS", $payment->semester, $currentYear);
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

        if (!empty($student) && $student->name == $request['name']) {
            $isValid = true;
        } else {
            $isValid = false;
            $student = [];
        }
     
        if (!empty($student)) {
            return view('cek_detail_payment.data')->with([
                'ukt' => Ukt::where('students_id', $student->id)->get(),
                'students' => Student::select('name', 'id', 'nim')->get(),
                'choice' => $student,
                'isValid' => $isValid,
            ]);
        } else{
            return view('cek_detail_payment.data')->with([
                'ukt' => Ukt::where('students_id', 0)->get(),
                'students' => Student::select('name', 'id', 'nim')->get(),
                'choice' => $student,
                'isValid' => $isValid,
            ]);
        }

        
    }

    // public function export(Request $request)
    // {
    //     $ukt = $this->setData($request->student);
    //     $student = Student::where('id', $request->student)->first();

    //     return view('report.printformat.pembayaran')->with([
    //         'ukt' => $ukt,
    //         'name' => $student->name,
    //         'nim' => $student->nim,
    //         'today' => date('d F Y', strtotime(date('Y-m-d'))),
    //         'title' => "Laporan Pembayaran Mahasiswa"
    //     ]);

    // }

    // public function setData($student_id)
    // {

    //     $dpp = Ukt::where('students_id', $student_id)->where('type', 'DPP')->latest('created_at')->get();
    //     $ukt = Ukt::where('students_id', $student_id)->where('type', 'UKT')->latest('created_at')->get();
    //     $wisuda = Ukt::where('students_id', $student_id)->where('type', 'WISUDA')->latest('created_at')->get();

    //     $detail = [];

    //     if (!$dpp->isEmpty()) {
    //         $data = [
    //             'tanggal' => $dpp->first()->created_at,
    //             'semester' => $dpp->first()->semester,
    //             'jenis' => $dpp->first()->type,
    //             'total' => $dpp->sum('amount'),
    //             'status' => $dpp->first()->status,
    //         ];
    //         array_push($detail, $data);
    //     }

    //     if (!$ukt->isEmpty()) {
    //         for ($i=0; $i < Ukt::max('semester'); $i++) {
    //             $uktsemester_total = $ukt->where('semester', $i+1)->sum('amount');
    //             $uktsemester_status = $ukt->where('semester', $i+1)->first()->status;
    //             $uktsemester_tanggal = $ukt->where('semester', $i+1)->first()->created_at;
    //             $uktsemester_jenis = $ukt->where('semester', $i+1)->first()->type;

    //             $data = [
    //                 'tanggal' => $uktsemester_tanggal,
    //                 'semester' => $i + 1,
    //                 'jenis' => $uktsemester_jenis,
    //                 'total' => $uktsemester_total,
    //                 'status' => $uktsemester_status,
    //             ];

    //             array_push($detail, $data);
    //         };
    //     }

    //     if (!$wisuda->isEmpty()) {
    //         $data = [
    //             'tanggal' => $wisuda->first()->created_at,
    //             'semester' => $wisuda->first()->semester,
    //             'jenis' => $wisuda->first()->type,
    //             'total' => $wisuda->sum('amount'),
    //             'status' => $wisuda->first()->status,
    //         ];

    //         array_push($detail, $data);
    //     }


    //     return $detail;

    // }
}
