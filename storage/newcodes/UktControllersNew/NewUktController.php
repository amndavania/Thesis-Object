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
     * Display a listing of the resource.
     */
    public function index() //menampilkan daftar pembayaran ukt
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
    public function destroy(String $id):RedirectResponse //menghapus data pembayaran dan entitas terkait
    {
        $ukt = Ukt::findOrFail($id);

        $this->deleteTransaction($ukt->transaction_debit_id); //Transaction
        $this->deleteTransaction($ukt->transaction_kredit_id);

        $this->deleteExamCard($ukt->exam_uts_id); //Exam Card
        $this->deleteExamCard($ukt->exam_uas_id);

        $this->deleteBimbinganStudi($ukt->lbs_id); //BimbinganStudy

        $this->updateTransactionAccount(1120, 'kredit', -$ukt->amount); //TransactionAccount
        $this->updateTransactionAccount(1130, 'debit', -$ukt->amount);

        $ukt->delete();

        return redirect()->route('ukt.index')->with(['success' => 'Data berhasil dihapus']);
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
            $status = app(StudentTypeController::class)->setStatus($totalPayment, $payment_type, $student_type); //ini dulunya pake $this
        }

        return $status;
    }

    // public function setStatus($amount, $payment_type, $student_type) //this, the student_type parameter's declared in the getStudentData line 184
    // {
    //     // dd($student_type);
    //     if ($payment_type == 'UKT') {
    //         $totalKRS = floatval($student_type->krs);
    //         $totalUTS = $totalKRS + $student_type->uts;
    //         $totalUAS = $totalUTS + $student_type->uas;

    //         // dd([$totalUAS, $totalUTS, $totalKRS, $amount]);

    //         if ($amount > $totalUAS) {
    //             $status = 'Lebih';
    //         } elseif ($amount == $totalUAS) {
    //             $status = 'Lunas';
    //         } elseif ($amount >= $totalUTS) {
    //             $status = 'Lunas UTS';
    //         } elseif ($amount >= $totalKRS) {
    //             $status = 'Lunas KRS';
    //         } else {
    //             $status = 'Belum Lunas';
    //         }

    //         // dd([$amount, $totalKRS, $totalUTS, $totalUAS, $status]);

    //     } elseif ($payment_type == 'DPP') {
    //         if ($amount < $student_type->dpp) {
    //             $status = 'Belum Lunas';
    //         }elseif ($amount == $student_type->dpp) {
    //             $status = 'Lunas';
    //         }elseif ($amount > $student_type->dpp) {
    //             $status = 'Lebih';
    //         }
    //     } elseif ($payment_type == 'WISUDA') {
    //         if ($amount < $student_type->wisuda) {
    //             $status = 'Belum Lunas';
    //         }elseif ($amount == $student_type->wisuda) {
    //             $status = 'Lunas';
    //         }elseif ($amount > $student_type->wisuda) {
    //             $status = 'Lebih';
    //         }
    //     }

    //     return $status;
    // }

    public function setKeterangan($studentData, $year, $semester, $payment_type, $status, $ukt)
    {
        // Langsung pakai instance $ukt yang baru dibuat
        if ($payment_type !== "UKT") {
            return;
        }
    
        $student = $studentData[0];
        $studentType = $studentData[1];
    
        $totalKRS = $studentType->krs;
        $totalUTS = $totalKRS + $studentType->uts;
    
        $bimbinganExists = BimbinganStudy::where('students_id', $student->id)
            ->where('year', $year)
            ->where('semester', $semester)
            ->exists();
    
        if ($status === "Lunas") {
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
    
        } elseif ($status === "Lunas UTS") {
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
    
        } elseif ($status === "Lunas KRS") {
            if (!$bimbinganExists) {
                $ukt->lbs_id = $this->createBimbinganStudy($student->id, $year, $semester);
            } else {
                $ukt->keterangan = 'Menunggu Dispensasi UTS';
            }
    
        } elseif ($status === "Belum Lunas") {
            $ukt->keterangan = 'Menunggu Dispensasi KRS';
        }
    
        $ukt->save();
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

    public function deleteExamCard($exam_id) //menghapus kartu ujian berdasarkan id, jika ada
    {
        $exam = ExamCard::where('id', $exam_id)->first();
        if (!empty($exam)) {
            $exam->delete();
        }
    }

    public function deleteBimbinganStudi($lbs_id) //mengahpus bimbingan studi berdasarkan id, jika ada
    {
        $bimbinganStudy = BimbinganStudy::where('id', $lbs_id)->first();
        if (!empty($bimbinganStudy)) {
            $bimbinganStudy->delete();
        }
    }
}
