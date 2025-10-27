<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ukt\UktCreateRequest;
use App\Models\BimbinganStudy;
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
     * Store a newly created resource in storage.
     */
    public function store(UktCreateRequest $request) //menyimpan data pembayaran baru
    {
        $created_at = Carbon::createFromFormat('Y-m-d', $request['created_at'])
                        ->setTime(00,00,00);
        $request['created_at'] = $created_at;

        $student_id = $request->students_id;
        $year = $request->year; 
        $semester = $request->semester;
        $payment_type = $request->type;
        $amount = $request->amount;

        //Get student and student type
        $studentData = $this->getStudentData($request->students_id); 

        //Hitung Semester
        if ($semester == "GASAL") {
            $semester_student = (($year - $studentData[0]->force) * 2) + 1;
            $yearPrevious = $year-1;
            $semesterPrevious = "GENAP";
        }elseif ($semester == "GENAP") {
            $semester_student = (($year - $studentData[0]->force) * 2) + 2;
            $yearPrevious = $year;
            $semesterPrevious = "GASAL";
        }

        $statusDPP = Ukt::where('students_id', $student_id)->where('type', "DPP")->orderBy('id', 'desc')->first();
        $statusUKT = Ukt::where('students_id', $student_id)->where('type', "UKT")->where('year', $yearPrevious)->where('semester', $semesterPrevious)->orderBy('id', 'desc')->first();

        if (($semester_student > 2 && empty($statusDPP)) || ($semester_student > 2 && $statusDPP->status == "Belum Lunas")) {
            return redirect()->route('ukt.index')->with(['error' => 'Harap lunasi DPP terlebih dahulu']);
        }elseif ((($semester_student != 1 && empty($statusUKT))) || ($semester_student != 1 && $statusUKT->status != "Lunas")) {
            return redirect()->route('ukt.index')->with(['error' => 'Harap lunasi UKT semester lalu terlebih dahulu']);
        }else {
            // Add Transaction on debit
            $user_id = $request->user()->id;
            $description = "Pembayaran " . $request->type . " " . $studentData[0]->nim . " " . $studentData[0]->name;
            $reference_number = $request->reference_number;
            $amount = $request->amount;
            $type = "debit";
            $transaction_accounts_id = 1130;

            $this->addTransaction($user_id, $description, $reference_number, $amount, $type, $transaction_accounts_id);
            $latestTransaction = Transaction::latest('id')->first();
            $request['transaction_debit_id'] = $latestTransaction->id;
            $this->updateTransactionAccount($transaction_accounts_id, $type, $amount);

            //Add Transaction on kredit
            $description = "Pendapatan " . $request->type . " " . $studentData[0]->nim . " " . $studentData[0]->name;
            $amount = $request->amount;
            $type = "kredit";
            $transaction_accounts_id = 1120;

            $this->addTransaction($user_id, $description, $reference_number, $amount, $type, $transaction_accounts_id);
            $latestTransaction = Transaction::latest('id')->first();
            $request['transaction_kredit_id'] = $latestTransaction->id;
            $this->updateTransactionAccount($transaction_accounts_id, $type, $amount);

            //Save data UKT
            $setTotalStatus = $this->setTotalStatus($student_id, $year, $semester, $payment_type, $studentData[1], $amount);
            $request['status'] = $setTotalStatus;

            $ukt = Ukt::create($request->all());
            $this->setKeterangan($studentData, $year, $semester, $payment_type, $setTotalStatus, $ukt);            

            return redirect()->route('ukt.index')->with(['success' => 'Data berhasil disimpan']);

        }
    }

    public function addTransaction($user_id, $description, $reference_number, $amount, $type, $transaction_accounts_id) //menambahkan data transaksi ke tabel transaction
    {
        Transaction::create([
            'user_id' => $user_id,
            'description' => $description,
            'reference_number' => $reference_number,
            'amount' => $amount,
            'type' => $type,
            'transaction_accounts_id' => $transaction_accounts_id
        ]);
    }

    public function deleteTransaction($transaction_id) //menghapus transaksi berdasarkan id
    {

        $transaction = Transaction::where('id', $transaction_id)->first();
        $transaction->delete();

    }

    public function updateTransactionAccount($transaction_accounts_id, $type, $amount) //mengupdate nilai debit atau kredit pada akun transaksi
    {
        $account = TransactionAccount::findOrFail($transaction_accounts_id);

        if ($type == 'kredit') {
            $ammount = $account->kredit;
            $inputAmount = $ammount + $amount;
            $account->fill(['kredit' => $inputAmount]);
        } elseif ($type == 'debit') {
            $ammount = $account->debit;
            $inputAmount = $ammount + $amount;
            $account->fill(['debit' => $inputAmount]);
        }

        $account->save();
    }

    public function getStudentData($student_id) //digunakan untuk memproses status pembayaran mahasiswa
    {
        $student = Student::where('id', $student_id)->first();
        $student_type = StudentType::where('id', $student->student_types_id)->first(); //student_type used in setstatus

        return [$student, $student_type];
    }

    public function setTotalStatus($student_id, $year, $semester, $payment_type, $student_type, $nominal) //menentukan status pembayaran seperti lunas, belum lunas, lunas uts
    {
        $payment = Ukt::where('students_id', $student_id)
            ->where('year', $year)
            ->where('semester', $semester)
            ->where('type', $payment_type)->get();
        $totalPayment = $payment->sum('amount') + $nominal;

        if ($payment_type == 'DPP') {
            $dpp = Ukt::where('students_id', $student_id)->where('year', $year)
                ->where('type', $payment_type)->get();
            $status = app(StudentTypeController::class)->setStatus(($dpp->sum('amount') + $nominal), $payment_type, $student_type); //ini dulunya pake $this
        } elseif ($payment_type == 'UKT') {
            $status = app(StudentTypeController::class)->setStatus($totalPayment, $payment_type, $student_type); //ini dulunya pake $this
        } elseif ($payment_type == 'WISUDA') {
            $status = app(StudentTypeController::class)->setStatus($totalPayment, $payment_type, $student_type); //s86
        }

        return $status; //s87
    }

    public function setKeterangan($studentData, $year, $semester, $payment_type, $status, $ukt) //s88
    {
        // Langsung pakai instance $ukt yang baru dibuat
        if ($payment_type !== "UKT") { //89
            return; //90
        }
    
        $student = $studentData[0]; //91
        $studentType = $studentData[1]; //92
    
        $totalKRS = $studentType->krs; //93
        $totalUTS = $totalKRS + $studentType->uts; //94
    
        $bimbinganExists = BimbinganStudy::where('students_id', $student->id) //95
            ->where('year', $year)
            ->where('semester', $semester)
            ->exists();
    
        if ($status === "Lunas") { //96
            if (!$bimbinganExists) { //97
                $ukt->lbs_id = $this->createBimbinganStudy($student->id, $year, $semester); //98
            }
    
            $examUTSExists = ExamCard::where('students_id', $student->id) //99
                ->where('semester', $semester)
                ->where('type', 'UTS')
                ->exists();
    
            $examUASExists = ExamCard::where('students_id', $student->id) //100
                ->where('semester', $semester)
                ->where('type', 'UAS')
                ->exists();
    
            if (!$examUTSExists) { //101
                $ukt->exam_uts_id = $this->createExamCard($student->id, 'UTS', $semester, $year); //102
            }
            if (!$examUASExists) { //103
                $ukt->exam_uas_id = $this->createExamCard($student->id, 'UAS', $semester, $year); //104
            }
    
        } elseif ($status === "Lunas UTS") { //105
            if (!$bimbinganExists) { //106
                $ukt->lbs_id = $this->createBimbinganStudy($student->id, $year, $semester); //107
            }
    
            $examUTSExists = ExamCard::where('students_id', $student->id) //108
                ->where('semester', $semester)
                ->where('type', 'UTS')
                ->exists();
    
            if (!$examUTSExists) { //109
                $ukt->exam_uts_id = $this->createExamCard($student->id, 'UTS', $semester, $year); //110
            } else {
                $ukt->keterangan = 'Menunggu Dispensasi UAS'; //111
            }
    
        } elseif ($status === "Lunas KRS") { //112
            if (!$bimbinganExists) { //113
                $ukt->lbs_id = $this->createBimbinganStudy($student->id, $year, $semester); //114
            } else {
                $ukt->keterangan = 'Menunggu Dispensasi UTS'; //115
            }
    
        } elseif ($status === "Belum Lunas") { //116
            $ukt->keterangan = 'Menunggu Dispensasi KRS'; //117
        }
    
        $ukt->save(); //118
    }

    public function createExamCard($student_id, $type, $semester, $year) //membuat kartu ujian (uts atau uas)
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

    public function createBimbinganStudy($student_id, $year, $semester) { //membuat entitas bimbingan studi (lbs) jika belum ada
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
}