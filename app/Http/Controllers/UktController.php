<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ukt\UktCreateRequest;
use App\Http\Requests\Ukt\UktUpdateRequest;
use App\Models\BimbinganStudy;
use App\Models\ExamCard;
use App\Models\Student;
use App\Models\StudentType;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\Ukt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class UktController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ukt.data')->with([
            'ukt' => Ukt::paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student = Student::all();
        $transaction_account = TransactionAccount::all();
        return view('ukt.create', compact('student', 'transaction_account'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UktCreateRequest $request)
    {
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
            $semester_student = (($year - $studentData[0]->force) * 2);
            $yearPrevious = $year;
            $semesterPrevious = "GASAL";
        }

        $dataUkt = Ukt::where('students_id', $student_id);
        $statusDPP = $dataUkt->where('type', 'DPP')->orderBy('id', 'desc')->first();
        $statusUKT = $dataUkt->where('type', 'UKT')->where('year', $yearPrevious)->where('semester', $semesterPrevious)->orderBy('id', 'desc')->first();

        if (($semester_student > 2 && $statusDPP->status == "Belum Lunas") || ($semester_student > 2 && empty($statusDPP))) {
            return redirect()->route('ukt.index')->with(['error' => 'Harap lunasi DPP terlebih dahulu']);
        }elseif (($semester_student != 1 && $statusUKT->status == "Belum Lunas") || (($semester_student != 1 && empty($statusUKT)))) {
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
            $this->updateTransactionAccount($transaction_accounts_id);

            //Add Transaction on kredit
            $description = "Pendapatan " . $request->type . " " . $studentData[0]->nim . " " . $studentData[0]->name;
            $amount = $request->amount;
            $type = "kredit";
            $transaction_accounts_id = 1120;

            $this->addTransaction($user_id, $description, $reference_number, $amount, $type, $transaction_accounts_id);
            $latestTransaction = Transaction::latest('id')->first();
            $request['transaction_kredit_id'] = $latestTransaction->id;
            $this->updateTransactionAccount($transaction_accounts_id);

            //Save data UKT
            $setTotalStatus = $this->setTotalStatus($student_id, $year, $semester, $payment_type, $studentData[1], $amount);
            $request['status'] = $setTotalStatus;

            Ukt::create($request->all());
            
            //Set keterangan
            $this->setKeterangan($studentData, $year, $semester, $payment_type, $setTotalStatus);

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
     * Show the form for editing the specified resource.
     */
    // public function edit(String $id)
    // {
    //     return view('ukt.edit')->with([
    //         'ukt' => Ukt::findOrFail($id),
    //         'transaction_account' => TransactionAccount::all(),
    //     ]);

    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UktUpdateRequest $request, String $id):RedirectResponse
    // {
    //     $ukt = Ukt::findOrFail($id);
    //     $request['students_id'] = $ukt->students_id;
    //     $request['type'] = $ukt->type;

    //     $student_id = $request->students_id;
    //     $semester = $request->semester;
    //     $payment_type = $request->type;
    //     $amount = $request->amount;

    //     //Get student and student type
    //     $student_type = $this->getStudentType($request->students_id);

    //     //Update Transaction on debit
    //     $student = Student::where('id', $request->students_id)->first();
    //     $user_id = $request->user()->id;
    //     $description = "Pembayaran " . $request->type . " " . $student->nim . " " . $student->name;
    //     $reference_number = $request->reference_number;
    //     $amount = $request->amount;
    //     $transaction_accounts_id = 1130;

    //     $this->updateTransaction($user_id, $description, $reference_number, $amount, $ukt->transaction_debit_id);
    //     $this->updateTransactionAccount($transaction_accounts_id);

    //     //Update Transaction on kredit
    //     $description = "Pendapatan " . $request->type . " " . $student->nim . " " . $student->name;
    //     $amount = $request->amount;
    //     $transaction_accounts_id = 1120;

    //     $this->updateTransaction($user_id, $description, $reference_number, $amount,  $ukt->transaction_kredit_id);
    //     $this->updateTransactionAccount($transaction_accounts_id);

    //     $request['total'] = 0;
    //     $request['status'] = '-';
    //     $request['transaction_accounts_id'] = 1130;
    //     $ukt->update($request->all());

    //     //Set total and payment status
    //     $setTotalStatus = $this->setTotalStatus($student_id, $semester, $payment_type, $student_type);
    //     $ukt->total = $setTotalStatus[0];
    //     $ukt->status = $setTotalStatus[1];
    //     $ukt->save();

    //     // $ukt->update($request->all());
    //     return redirect()->route('ukt.index')->with(['success' => 'Data berhasil diupdate']);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id):RedirectResponse
    {
        $ukt = Ukt::findOrFail($id);

        $this->deleteTransaction($ukt->transaction_debit_id);
        $this->deleteTransaction($ukt->transaction_kredit_id);

        $this->deleteExamCard($ukt->exam_uts_id);
        $this->deleteExamCard($ukt->exam_uas_id);

        $this->updateTransactionAccount(1120);
        $this->updateTransactionAccount(1130);

        $ukt->delete();

        return redirect()->route('ukt.index')->with(['success' => 'Data berhasil dihapus']);
    }

    public function addTransaction($user_id, $description, $reference_number, $amount, $type, $transaction_accounts_id)
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

    // public function updateTransaction($user_id, $description, $reference_number, $amount, $transaction_id)
    // {

    //     $transaction = Transaction::where('id', $transaction_id)->first();

    //     if (!empty($transaction)) {
    //         $transaction->user_id = $user_id;
    //         $transaction->description = $description;
    //         $transaction->reference_number = $reference_number;
    //         $transaction->amount = $amount;

    //         $transaction->save();
    //     }

    // }

    public function deleteTransaction($transaction_id)
    {

        $transaction = Transaction::where('id', $transaction_id)->first();
        $transaction->delete();

    }

    public function updateTransactionAccount($transaction_accounts_id)
    {
        $transactions = Transaction::where('transaction_accounts_id', $transaction_accounts_id)->get();

        if (empty($transactions)){
            $ammount = 0;
        }else {
            $ammount = $transactions->sum('amount');
        }

        $account = TransactionAccount::findOrFail($transaction_accounts_id);
        $account->fill(['amount' => $ammount]);

        $account->save();
    }

    public function getStudentData($student_id)
    {
        $student = Student::where('id', $student_id)->first();
        $student_type = StudentType::where('id', $student->student_types_id)->first();

        return [$student, $student_type];
    }

    public function setTotalStatus($student_id, $year, $semester, $payment_type, $student_type, $nominal)
    {
        $payment = Ukt::where('students_id', $student_id)
            ->where('year', $year)
            ->where('semester', $semester)
            ->where('type', $payment_type)->get();
        $totalPayment = $payment->sum('amount') + $nominal;

        if ($payment_type == 'DPP') {
            $total = $student_type->dpp;
            $dpp = Ukt::where('students_id', $student_id)->where('year', $year)
                ->where('type', $payment_type)->get();
            $status = $this->setStatus(($dpp->sum('amount') + $nominal), $total);
        } elseif ($payment_type == 'UKT') {
            $total = $student_type->krs + $student_type->uts + $student_type->uas;
            $status = $this->setStatus(($totalPayment), $total);
        } elseif ($payment_type == 'WISUDA') {
            $total = $student_type->wisuda;
            $status = $this->setStatus(($totalPayment), $total);
        }

        return $status;
    }

    public function setStatus($amount, $total)
    {
        if ($amount < $total) {
            $status = 'Belum Lunas';
        }elseif ($amount == $total) {
            $status = 'Lunas';
        }elseif ($amount > $total) {
            $status = 'Lebih';
        }

        return $status;
    }

    public function setKeterangan($studentData, $year, $semester, $payment_type, $status) 
    {
        $payment = Ukt::latest()->first();

        if ($payment_type == "UKT") {
            $ukt = Ukt::where('students_id', $studentData[0]->id)
                ->where('year', $year)
                ->where('semester', $semester)
                ->where('type', $payment_type)->get();

            $totalKRS = $studentData[1]->krs;
            $totalUTS = $totalKRS + $studentData[1]->uts;
            $totalPayment = $ukt->sum('amount');

            $bimbinganStudy = BimbinganStudy::where('students_id', $studentData[0]->id)
                    ->where('year', $year)->where('semester', $semester)->exists();

            if ($status == "Lunas") {
                $payment->keterangan = 'UAS';
                if (!$bimbinganStudy) {
                    $payment->lbs_id = $this->createBimbinganStudy($studentData[0]->id, $year, $semester);
                }
            } elseif ($status == "Belum Lunas") {
                if ($totalPayment >= $totalUTS) {
                    if (!$bimbinganStudy) {
                        $payment->keterangan = 'UTS';
                        $payment->lbs_id = $this->createBimbinganStudy($studentData[0]->id, $year, $semester);
                    } else {
                        $payment->keterangan = 'Menunggu Dispensasi UAS';
                    }
                } elseif ($totalPayment >= $totalKRS) {
                    if (!$bimbinganStudy) {
                        $payment->keterangan = 'KRS';
                        $payment->lbs_id = $this->createBimbinganStudy($studentData[0]->id, $year, $semester);
                    } else {
                        $payment->keterangan = 'Menunggu Dispensasi UTS';
                    }
                } elseif ($totalPayment < $totalKRS) {
                    $payment->keterangan = 'Menunggu Dispensasi KRS';
                }
            }
        }

        $payment->save();
    }

    public function createExamCard($student_id, $type, $semester, $year)
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
    {
        $exam = ExamCard::where('id', $exam_id)->first();
        if (!empty($exam)) {
            $exam->delete();
        }
    }



    public function setKeterangan1($studentData, $year, $semester, $payment_type, $status, $nominal) 
    {
        $payment = Ukt::latest()->first();

            if ($payment_type == "UKT") {
                $ukt = Ukt::where('students_id', $studentData[0]->id)
                    ->where('year', $year)
                    ->where('semester', $semester)
                    ->where('type', $payment_type)->get();
                $totalKRS = $studentData[1]->krs;
                $totalUTS = $totalKRS + $studentData[1]->uts;
                $totalUAS = $totalUTS + $studentData[1]->uas;
                $totalPayment = $ukt->sum('amount') + $nominal;

                if ($status == "Lunas") {
                    $payment->keterangan = 'ALL';
                    $exam_uts = ExamCard::where('students_id', $studentData[0]->id)->where('semester', $semester)->where('type', "UTS")->exists();
                    $exam_uas = ExamCard::where('students_id', $studentData[0]->id)->where('semester', $semester)->where('type', "UAS")->exists();
                    if (!$exam_uts && !$exam_uas) {
                        $payment->exam_uts_id = $this->createExamCard($studentData[0]->id, "UTS", $semester, $year);
                        $payment->exam_uas_id = $this->createExamCard($studentData[0]->id, "UAS", $semester, $year);
                    }elseif (!$exam_uas && $exam_uts) {
                        $payment->exam_uas_id = $this->createExamCard($studentData[0]->id, "UAS", $semester, $year);
                    }elseif (!$exam_uts && $exam_uas) {
                        $payment->exam_uts_id = $this->createExamCard($studentData[0]->id, "UTS", $semester, $year);
                    }
                } elseif ($status == "Belum Lunas") {
                    if ($totalPayment >= $totalUTS) {
                        $card = ExamCard::where('students_id', $studentData[0]->id)
                            ->where('semester', $semester)->where('type', "UTS")->exists();
                        if (empty($card)) {
                            $payment->keterangan = 'UTS';
                            $payment->exam_uts_id = $this->createExamCard($studentData[0]->id, "UTS", $semester, $year);
                        } else{
                            $payment->keterangan = 'Menunggu Dispensasi UAS';
                        }
                    } elseif ($totalPayment >= $totalKRS) {
                        $card = Ukt::where('students_id', $studentData[0]->id)
                            ->where('semester', $semester)->where('keterangan', "KRS")->exists();
                        if (empty($card)) {
                            $payment->keterangan = 'KRS';
                        } else {
                            $payment->keterangan = 'Menunggu Dispensasi UTS';
                        }
                    } elseif ($totalPayment < $totalKRS) {
                        $keterangan = 'Menunggu Dispensasi KRS';
                    }
                }
            }
    }
}
