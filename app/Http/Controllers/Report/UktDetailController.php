<?php

//One of the refactoring : Extract Method 
// The testing file is : UktDetailControllerTest.php
// Refactored method : index()

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
        $uktController = new UktController; //S2

        $selectStudent = Student::select('name', 'id', 'nim')->get(); //S3
        $selectFaculty = Faculty::select('id', 'name')->get(); //S4
        $filter = empty($request->filterUkt) ? "student" : $request->filterUkt; //S5

        if ($filter == "student") { //S6
            $student_id = $request->input('students_id'); //S7
            $payment_id = $request->input('id');          //S8
            $dispensasi = $request->input('dispensasi');  //S9

            return $this->handleStudentFilter(
                $student_id,
                $payment_id,
                $dispensasi,
                $uktController,
                $selectStudent,
                $selectFaculty,
                $filter
            );

        } elseif ($filter == "faculty") { //S40
            $faculty_id = $request->faculty_id;
            $datepicker = $request->datepicker;

            return $this->handleFacultyFilter(
                $faculty_id,
                $datepicker,
                $selectStudent,
                $selectFaculty,
                $filter
            );
        }
    }

    private function handleStudentFilter($student_id, $payment_id, $dispensasi, $uktController, $selectStudent, $selectFaculty, $filter)
    {
        if (!empty($payment_id) && !empty($dispensasi)) { //S10
            $this->processDispensasi($student_id, $payment_id, $dispensasi, $uktController);
        }

        if (empty($student_id)) { //S23
            $student_id = $this->getDefaultStudentId(); //S25/S26
        }

        $student = Student::where('id', $student_id)->first(); //S27

        if (!empty($student)) { //S28
            $ukt = Ukt::where('students_id', $student->id)->latest()->get(); //S29
            $totalUkt = $ukt->sum('amount'); //S30
        } else {
            $ukt = null; //S31
            $totalUkt = 0; //S32
        }

        return view('detail_payment.ukt')->with([ //S33
            'ukt' => $ukt,             //S34
            'students' => $selectStudent, //S35
            'choice' => $student,      //S36
            'faculty' => $selectFaculty, //S37
            'totalUkt' => $totalUkt,   //S38
            'filter' => $filter,       //S39
        ]);
    }

    private function processDispensasi($student_id, $payment_id, $dispensasi, $uktController)
    {
        $payment = Ukt::where('id', $payment_id)->first(); //S11
        $bimbinganStudy = BimbinganStudy::where('students_id', $student_id) //S12
            ->where('year', $payment->year)
            ->where('semester', $payment->semester)
            ->first();

        if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") { //S13
            $payment->keterangan = "Dispen UTS"; //S14
            $payment->exam_uts_id = $uktController->createExamCard($student_id, "UTS", $payment->semester, $payment->year); //S15
        } elseif ($dispensasi == "Menunggu Dispensasi UAS" && $bimbinganStudy->status == "Aktif") { //S16
            $payment->keterangan = "Dispen UAS"; //S17
            $payment->exam_uas_id = $uktController->createExamCard($student_id, "UAS", $payment->semester, $payment->year); //S18
        } elseif ($dispensasi == "Menunggu Dispensasi KRS") { //S19
            $payment->keterangan = "Dispen KRS"; //S20
            $payment->lbs_id = $uktController->createBimbinganStudy($student_id, $payment->year, $payment->semester); //S21
        }

        $payment->save(); //S22
    }

    private function getDefaultStudentId()
    {
        if (Student::first()) { //S24
            return Student::first()->id; //S25
        }
        return null; //S26
    }

    private function handleFacultyFilter($faculty_id, $datepicker, $selectStudent, $selectFaculty, $filter)
    {
        $getDate = $this->getDate($datepicker);

        if (empty($faculty_id)) {
            $faculty_id = $this->getDefaultFacultyId();
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
            ->where(function ($query) {
                $query->where('type', 'UKT')
                      ->orWhere('type', 'DPP');
            })->get();

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

    private function getDefaultFacultyId()
    {
        if (Faculty::first()) {
            return Faculty::first()->id;
        }
        return null;
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
            ->where(function ($query) {
                $query->where('type', 'UKT')
                      ->orWhere('type', 'DPP');
            })->get();

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
