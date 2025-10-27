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

    public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
    {
        $uktController = new UktController;

        // handle bimbingan study
        $this->handleBimbinganStudy($id, $status, $student_id, $tahunAjaran, $semester);

        // handle payment & exam cards
        $payment = Ukt::where('lbs_id', $id)->first();
        if ($payment) {
            $uts_id = $payment->exam_uts_id;
            $uas_id = $payment->exam_uas_id;

            $this->handleExamCardLunasUts($payment, $status, $uts_id, $uktController);
            $this->handleExamCardLunas($payment, $status, $uts_id, $uas_id, $uktController);

            $payment->save();
        } else {
            $this->handleInactiveStatus($status, $id);
        }
    }


    private function handleBimbinganStudy($id, $status, $student_id, $tahunAjaran, $semester)
    {
        if (empty($id)) {
            return BimbinganStudy::create([
                'students_id' => $student_id,
                'year' => $tahunAjaran,
                'semester' => $semester,
                'status' => $status
            ]);
        } else {
            $bimbinganStudy = BimbinganStudy::find($id);
            $bimbinganStudy->status = $status;
            $bimbinganStudy->save();
            return $bimbinganStudy;
        }
    }

    private function handleExamCardLunasUts($payment, $status, $uts_id, $uktController)
    {
        if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {
            $payment->exam_uts_id = $uktController->createExamCard(
                $payment->students_id, "UTS", $payment->semester, $payment->year
            );
        } elseif ($status == "Tunda") {
            ExamCard::destroy([$uts_id]);
            $payment->exam_uts_id = null;
        }
    }

    private function handleExamCardLunas($payment, $status, $uts_id, $uas_id, $uktController)
    {
        if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {
            $payment->exam_uts_id = $uktController->createExamCard(
                $payment->students_id, "UTS", $payment->semester, $payment->year
            );
            $payment->exam_uas_id = $uktController->createExamCard(
                $payment->students_id, "UAS", $payment->semester, $payment->year
            );
        } elseif ($status == "Tunda") {
            ExamCard::destroy([$uts_id, $uas_id]);
            $payment->exam_uts_id = $payment->exam_uas_id = null;
        }
    }

    private function handleInactiveStatus($status, $id)
    {
        if ($status == "Tidak Aktif" && $id) {
            BimbinganStudy::destroy($id);
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
