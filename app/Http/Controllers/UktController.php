<?php

namespace App\Http\Controllers; //One of the refactoring : Extract Method 
use App\Http\Requests\Ukt\UktCreateRequest; // The testing file is : OldUktControllerTest.php and NewTest.php
use App\Models\BimbinganStudy; // Refactored method : setKeterangan and store()
use App\Models\ExamCard;
use App\Models\Student;
use App\Models\StudentType;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\Ukt;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class UktController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    //menampilkan daftar pembayaran ukt
    {
        return view('ukt.data')->with([
            'ukt' => Ukt::latest()->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() //menampilkan form pembuatan data ukt
    {
        $student = Student::all();
        $transaction_account = TransactionAccount::all();
        return view('ukt.create', compact('student', 'transaction_account'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UktCreateRequest $request) 
    //menyimpan data pembayaran baru //S1
    {
        $this->transactionServiceController = new TransactionServiceController();
        
        $created_at = Carbon::createFromFormat('Y-m-d', $request['created_at'])->setTime(00,00,00); 
        //S2
        $request['created_at'] = $created_at; 
        //S3

        $student_id = $request->students_id; 
        //S4
        $year = $request->year; 
        //S5
        $semester = $request->semester; 
        //S6
        $payment_type = $request->type; 
        //S7
        $amount = $request->amount; 
        //S8

        //Get student and student type
        $studentData = $this->getStudentData($request->students_id); 

        $force = $studentData[0]->force;
        [$semester_student, $yearPrevious, $semesterPrevious] = $this->calculateSemesterInfo($semester, $year, $force);

        $statusDPP = Ukt::where('students_id', $student_id)->where('type', "DPP")->orderBy('id', 'desc')->first(); 
        $statusUKT = Ukt::where('students_id', $student_id)->where('type', "UKT")->where('year', $yearPrevious)->where('semester', $semesterPrevious)->orderBy('id', 'desc')->first(); 

        $redirect = $this->validatePreviousPayments($semester_student, $statusDPP, $statusUKT);
        if ($redirect) {
            return $redirect;
        }
        // Add Transaction on debit
        $user_id = $request->user()->id;
        $reference_number = $request->reference_number;
        $transaction_debit_id = $this->transactionServiceController->handleDebitTransaction($user_id, $studentData[0], $reference_number, $payment_type, $amount);
        $request['transaction_debit_id'] = $transaction_debit_id;

        //Add Transaction on kredit
        $transaction_kredit_id = $this->transactionServiceController->handleKreditTransaction($user_id, $studentData[0], $reference_number, $payment_type, $amount);
        $request['transaction_kredit_id'] = $transaction_kredit_id;

        //Save data UKT
        $setTotalStatus = $this->setTotalStatus($student_id, $year, $semester, $payment_type, $studentData[1], $amount); 
        //s42 Menentukan apakah pembayaran sudah lunas, atau hanya sebagian.
        $request['status'] = $setTotalStatus; 
        //s43 Menyimpan ke tabel ukts, lalu proses kelanjutan (bimbingan, kartu ujian) or Simpan entitas UKT dan proses lanjutan ke set keterangan

        $ukt = Ukt::create($request->all());
        //Set keterangan
        $this->setKeterangan($studentData, $year, $semester, $payment_type, $setTotalStatus, $ukt); 
        //s45   

        return redirect()->route('ukt.index')->with(['success' => 'Data berhasil disimpan']); 
        //s46 Redirect setelah simpan berhasil.
    }

    private function calculateSemesterInfo(string $semester, int $year, int $force): array 
    {
        if ($semester === "GASAL") {
            $semester_student = (($year - $force) * 2) + 1;
            $yearPrevious = $year - 1;
            $semesterPrevious = "GENAP";
        } elseif ($semester === "GENAP") {
            $semester_student = (($year - $force) * 2) + 2;
            $yearPrevious = $year;
            $semesterPrevious = "GASAL";
        }

        return [$semester_student, $yearPrevious, $semesterPrevious];
    }

    private function validatePreviousPayments(int $semester_student, $statusDPP, $statusUKT)
    {
        if (($semester_student > 2 && empty($statusDPP)) || ($semester_student > 2 && $statusDPP->status == "Belum Lunas")) {
            return redirect()->route('ukt.index')->with(['error' => 'Harap lunasi DPP terlebih dahulu']);
        } elseif ((($semester_student != 1 && empty($statusUKT))) || ($semester_student != 1 && $statusUKT->status != "Lunas")) {
            return redirect()->route('ukt.index')->with(['error' => 'Harap lunasi UKT semester lalu terlebih dahulu']);
        }

        return null;
    }

    /**
     * Display the specified resource.
     */
    public function show(Ukt $ukt)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id):RedirectResponse 
    //menghapus data pembayaran dan entitas terkait
    {
        $this->transactionServiceController = new TransactionServiceController();
        
        $ukt = Ukt::findOrFail($id);

        $this->transactionServiceController->deleteTransaction($ukt->transaction_debit_id); 
        //Transaction
        $this->transactionServiceController->deleteTransaction($ukt->transaction_kredit_id);

        $this->deleteExamCard($ukt->exam_uts_id); 
        //Exam Card
        $this->deleteExamCard($ukt->exam_uas_id);

        $this->deleteBimbinganStudi($ukt->lbs_id); 
        //BimbinganStudy

        $this->transactionServiceController->updateTransactionAccount(1120, 'kredit', -$ukt->amount); 
        //TransactionAccount
        $this->transactionServiceController->updateTransactionAccount(1130, 'debit', -$ukt->amount);

        $ukt->delete();

        return redirect()->route('ukt.index')->with(['success' => 'Data berhasil dihapus']);
    }

    public function getStudentData($student_id) 
    //digunakan untuk memproses status pembayaran mahasiswa
    {
        $student = Student::where('id', $student_id)->first();
        $student_type = StudentType::where('id', $student->student_types_id)->first(); 
        //student_type used in setstatus

        return [$student, $student_type];
    }

    public function setTotalStatus($student_id, $year, $semester, $payment_type, $student_type, $nominal) 
    //menentukan status pembayaran seperti lunas, belum lunas, lunas uts
    {
        $payment = Ukt::where('students_id', $student_id)
            ->where('year', $year)
            ->where('semester', $semester)
            ->where('type', $payment_type)->get();
        $totalPayment = $payment->sum('amount') + $nominal;

        if ($payment_type == 'DPP') {
            $dpp = Ukt::where('students_id', $student_id)->where('year', $year)
                ->where('type', $payment_type)->get();
            $status = app(StudentTypeController::class)->setStatus(($dpp->sum('amount') + $nominal), $payment_type, $student_type); 
            //ini dulunya pake $this
        } elseif ($payment_type == 'UKT') {
            $status = app(StudentTypeController::class)->setStatus($totalPayment, $payment_type, $student_type); 
            //ini dulunya pake $this
        } elseif ($payment_type == 'WISUDA') {
            $status = app(StudentTypeController::class)->setStatus($totalPayment, $payment_type, $student_type); 
            //ini dulunya pake $this
        }

        return $status;
    }

    public function setKeterangan($studentData, $year, $semester, $payment_type, $status, $ukt) 
    {
        if ($payment_type !== "UKT") { 
            return; 
        }
    
        $student = $studentData[0];
        $studentType = $studentData[1]; 
    
        $totalKRS = $studentType->krs; 
        $totalUTS = $totalKRS + $studentType->uts; 
    
        $bimbinganExists = $this->bimbinganExists($student->id, $year, $semester);
    
        if ($status === "Lunas") {
            $this->handleStatusLunas($ukt, $student, $year, $semester, $bimbinganExists);
        } 
        elseif ($status === "Lunas UTS") { 
            $this->handleStatusLunasUts($ukt, $student, $year, $semester, $bimbinganExists);
        } 
        elseif ($status === "Lunas KRS") { 
            $this->handleStatusLunasKrs($ukt, $student, $year, $semester, $bimbinganExists);
        } 
        elseif ($status === "Belum Lunas") { 
            $this->handleStatusBelumLunas($ukt); 
        }
    
        $ukt->save(); 
    }

    private function bimbinganExists($student_id, $year, $semester)
    {
        return BimbinganStudy::where('students_id', $student_id)
            ->where('year', $year)
            ->where('semester', $semester)
            ->exists();
    }
    

    private function handleStatusLunas($ukt, $student, $year, $semester, $bimbinganExists)
    {
        if (!$bimbinganExists) {
            $ukt->lbs_id = $this->createBimbinganStudy($student->id, $year, $semester);
        }

        $examUTSExists = ExamCard::where('students_id', $student->id)
            ->where('semester', $semester)
            ->where('type', 'UTS')
            ->exists();

        $examUASExists = ExamCard::where('students_id', $student->id)
            ->where('semester', $semester)
            ->where('type', 'UAS')
            ->exists();

        if (!$examUTSExists) {
            $ukt->exam_uts_id = $this->createExamCard($student->id, 'UTS', $semester, $year);
        }

        if (!$examUASExists) {
            $ukt->exam_uas_id = $this->createExamCard($student->id, 'UAS', $semester, $year);
        }
    }


    private function handleStatusLunasUts($ukt, $student, $year, $semester, $bimbinganExists)
    {
        if (!$bimbinganExists) {
            $ukt->lbs_id = $this->createBimbinganStudy($student->id, $year, $semester);
        }
    
        $examUTSExists = ExamCard::where('students_id', $student->id)
            ->where('semester', $semester)
            ->where('type', 'UTS')
            ->exists();
    
        if (!$examUTSExists) {
            $ukt->exam_uts_id = $this->createExamCard($student->id, 'UTS', $semester, $year);
        } else {
            $ukt->keterangan = 'Menunggu Dispensasi UAS';
        }
    }


    private function handleStatusLunasKrs($ukt, $student, $year, $semester, $bimbinganExists)
    {
        if (!$bimbinganExists) {
            $ukt->lbs_id = $this->createBimbinganStudy($student->id, $year, $semester);
        } else {
            $ukt->keterangan = 'Menunggu Dispensasi UTS';
        }
    }


    private function handleStatusBelumLunas($ukt)
    {
        $ukt->keterangan = 'Menunggu Dispensasi KRS';
    }

    public function createExamCard($student_id, $type, $semester, $year) 
    //membuat kartu ujian (uts atau uas)
    {
        $examcard = [
            'students_id' => $student_id,
            'type' => $type,
            'semester' => $semester,
            'year' => $year,
        ];

        ExamCard::create($examcard);

        $exam_id = ExamCard::where('students_id', $student_id)->where('semester', $semester)->where('type', $type)->latest('created_at')->first();

        return $exam_id->id;

    }

    public function createBimbinganStudy($student_id, $year, $semester) { 
        //membuat entitas bimbingan studi (lbs) jika belum ada
        $bimbinganStudy = [
            'students_id' => $student_id,
            'year' => $year,
            'semester' => $semester,
            'status' => "Tunda"
        ];

        BimbinganStudy::create($bimbinganStudy);

        $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('semester', $semester)->latest('created_at')->first();

        return $bimbinganStudy->id;
    }

    public function deleteExamCard($exam_id) 
    //menghapus kartu ujian berdasarkan id, jika ada
    {
        $exam = ExamCard::where('id', $exam_id)->first();
        if (!empty($exam)) {
            $exam->delete();
        }
    }

    public function deleteBimbinganStudi($lbs_id) 
    //mengahpus bimbingan studi berdasarkan id, jika ada
    {
        $bimbinganStudy = BimbinganStudy::where('id', $lbs_id)->first();
        if (!empty($bimbinganStudy)) {
            $bimbinganStudy->delete();
        }
    }
}
