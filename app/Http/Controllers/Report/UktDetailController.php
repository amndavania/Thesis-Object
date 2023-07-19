<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UktController;
use App\Models\BimbinganStudy;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Ukt;
use DateTime;
use Illuminate\Http\Request;

class UktDetailController extends Controller
{
    public function index(Request $request)
    {
        $uktController = new UktController;

        $selectStudent = Student::select('name', 'id', 'nim')->get();
        $selectFaculty = Faculty::select('id', 'name')->get();
        $filter = empty($request->filterUkt) ? "student" : $request->filterUkt;

        if ($filter == "student") {
            $student_id = $request->input('students_id');

            $payment_id = $request->input('id');
            $dispensasi = $request->input('dispensasi');

            if (!empty($payment_id) && !empty($dispensasi)) {
                $payment = Ukt::where('id', $payment_id)->first();
                $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();

                if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") {
                    $payment->keterangan = "Dispen UTS";
                    $payment->exam_uts_id = $uktController->createExamCard($student_id, "UTS", $payment->semester, $payment->year);
                } elseif ($dispensasi == "Menunggu Dispensasi UAS" && $bimbinganStudy->status == "Aktif") {
                    $payment->keterangan = "Dispen UAS";
                    $payment->exam_uas_id = $uktController->createExamCard($student_id, "UAS", $payment->semester, $payment->year);
                } elseif ($dispensasi == "Menunggu Dispensasi KRS") {
                    $payment->keterangan = "Dispen KRS";
                    $payment->lbs_id = $uktController->createBimbinganStudy($student_id, $payment->year, $payment->semester );
                }
                $payment->save();
            }

            if (empty($student_id)) {
                if (Student::first()) {
                    $student_id = Student::first()->id;
                } else {
                    $student_id = null;
                }
            }

            $student = Student::where('id', $student_id)->first();

            if (!empty($student)) {
                $ukt = Ukt::where('students_id', $student->id)->latest()->get();
                $totalUkt = $ukt->sum('amount');
            } else {
                $ukt = null;
                $totalUkt = 0;
            }

            return view('detail_payment.ukt')->with([
                'ukt' => $ukt,
                'students' => $selectStudent,
                'choice' => $student,
                'faculty' => $selectFaculty,
                'totalUkt' => $totalUkt,
                'filter' => $filter,
            ]);

        } elseif ($filter == "faculty") {
            $faculty_id = $request->faculty_id;
            $datepicker = $request->datepicker;

            $getDate = $this->getDate($datepicker);

            if (empty($faculty_id)) {
                if (Faculty::first()) {
                    $faculty_id = Faculty::first()->id;
                } else {
                    $faculty_id = null;
                }
            }

            $faculty = Faculty::where('id', $faculty_id)->first();

            if (!empty($faculty)) {
                $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
                    $query->select('id')
                        ->from('students')
                        ->whereIn('study_program_id', function ($query) use ($faculty_id) {
                            $query->select('id')
                                ->from('study_programs')
                                ->where('faculty_id', $faculty_id);
                        });
                })
                ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$getDate[0]])
                ->where('type', "UKT")
                ->get();
                $totalUkt = $ukt->sum('amount');
            } else {
                $ukt = null;
                $totalUkt = 0;
            }

            return view('detail_payment.ukt')->with([
                'ukt' => $ukt,
                'students' => $selectStudent,
                'choice' => $faculty,
                'faculty' => $selectFaculty,
                'totalUkt' => $totalUkt,
                'filter' => $filter,
                'datepicker' => $getDate[1]
            ]);


        }

    }

    public function export(Request $request)
    {
        $filter = $request->filter;

        if ($filter == "student") {
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
        } elseif ($filter == "faculty") {
            $faculty_id = $request->faculty;
            $datepicker = $request->datepicker;

            $dateTime = DateTime::createFromFormat('F Y', $datepicker);
            $date = $dateTime->format('m-Y');

            $getDate = $this->getDate($date);

            $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
                $query->select('id')
                    ->from('students')
                    ->whereIn('study_program_id', function ($query) use ($faculty_id) {
                        $query->select('id')
                            ->from('study_programs')
                            ->where('faculty_id', $faculty_id);
                    });
            })
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$getDate[0]])
            ->where('type', "UKT")
            ->get();

            $totalUkt = $ukt->sum('amount');

            $faculty = Faculty::where('id', $faculty_id)->first();

            return view('report.printformat.pembayaranfaculty')->with([
                'ukt' => $ukt,
                'faculty' => $faculty->name,
                'month' => $datepicker,
                'totalUkt' => $totalUkt,
                'today' => date('d F Y', strtotime(date('Y-m-d'))),
                'title' => "Laporan Pembayaran Mahasiswa"
            ]);
        }

    }

    public function getDate($datepicker)
    {

        if (empty($datepicker)) {
            $date = date('Y-m');
            $dateTime = new DateTime($date);
            $formattedDate = $dateTime->format('F Y');
        }else {
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $formattedDate = $parsedDate->format('F Y');
            $date = $parsedDate->format('Y-m');
        }

        return [$date, $formattedDate];
    }
}
