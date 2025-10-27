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
use App\Http\Controllers\ExportsKrs;

class CekPembayaranController extends Controller 
{
    use ExportsKrs; 
    // Trait digunakan untuk mendukung proses ekspor KRS mahasiswa

    public function index() 
    {
        return view('cek_detail_payment.form'); 
    }

    public function data(Request $request) 
    {
        $uktController = new UktController; 
        // Ambil data dari request (id mahasiswa, id pembayaran, dan dispensasi)
        $student_id = $request->input('students_id'); 
        $payment_id = $request->input('id'); 
        $dispensasi = $request->input('dispensasi'); 

         // Pastikan student_id terisi valid (jika kosong, ambil default)
        $student_id = $this->resolveStudentId($student_id); 

        // Tangani proses dispensasi berdasarkan status pembayaran
        $this->handleDispensasi($uktController, $student_id, $payment_id, $dispensasi); 
    
        // Lanjutkan ke tahap validasi nama dan nim mahasiswa
        return $this->handleStudentValidationAndResponse($request); 
    }

    private function handleDispensasi ($uktController, $student_id, $payment_id, $dispensasi)
    {
        if (!empty($payment_id) && !empty($dispensasi)) {
            // Ambil data pembayaran sesuai ID
            $payment = Ukt::where('id', $payment_id)->first();
            
            // Cek status bimbingan study berdasarkan tahun & semester
            $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)
                ->where('year', $payment->year)
                ->where('semester', $payment->semester)
                ->first();

            // Buat kartu ujian atau bimbingan sesuai jenis dispensasi
            if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") {
                $payment->keterangan = "UTS";
                $payment->exam_uts_id = $uktController->createExamCard($student_id, "UTS", $payment->semester, $payment->year);
            } elseif ($dispensasi == "Menunggu Dispensasi UAS" && $bimbinganStudy->status == "Aktif") {
                $payment->keterangan = "UAS";
                $payment->exam_uas_id = $uktController->createExamCard($student_id, "UAS", $payment->semester, $payment->year);
            } elseif ($dispensasi == "Menunggu Dispensasi KRS") {
                $payment->keterangan = "KRS";
                $payment->lbs_id = $uktController->createBimbinganStudy($student_id, $payment->year, $payment->semester);
            }
            // Simpan perubahan setelah dispensasi ditangani
            $payment->save();
        }
    }

    private function resolveStudentId($student_id)
    {
        if (empty($student_id)) {
            $student_first = Student::first();
            if ($student_first) {
                return $student_first->id;
            }
        }
        return $student_id;
    }


    // =====================================================================
    // Validasi nama & NIM mahasiswa dan kembalikan hasilnya ke tampilan
    // =====================================================================
    private function handleStudentValidationAndResponse(Request $request)
    {
        // Cari mahasiswa berdasarkan NIM
        $student = Student::where('nim', $request['nim'])->first();

        // Validasi kesesuaian nama mahasiswa
        if (!empty($student) && strcasecmp($student->name, $request['name']) === 0) {
            $isValid = true;
        } else {
            $isValid = false;
            $student = [];
        }

        // Jika mahasiswa valid, tampilkan data UKT-nya
        if (!empty($student)) {
            return view('cek_detail_payment.data')->with([
                'ukt' => Ukt::where('students_id', $student->id)->latest()->get(),
                'students' => Student::select('name', 'id', 'nim')->get(),
                'choice' => $student,
                'isValid' => $isValid,
            ]);
        } else {
            return view('cek_detail_payment.data')->with([
                'ukt' => Ukt::where('students_id', 0)->get(),
                'students' => Student::select('name', 'id', 'nim')->latest()->get(),
                'choice' => $student,
                'isValid' => $isValid,
            ]);
        }
    }

    // =====================================================================
    // Ekspor laporan pembayaran mahasiswa ke tampilan laporan cetak
    // =====================================================================
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

    // =====================================================================
    // Ekspor data bimbingan (LBS/KRS) mahasiswa ke format laporan
    // =====================================================================
    public function exportLBS(Request $request) //this?
    {
        $data = $this->generateKrsData($request->id);
        return view('report.printformat.krs')->with($data);
    }

    // =====================================================================
    // Menampilkan kartu ujian berdasarkan ID yang dipilih
    // =====================================================================
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