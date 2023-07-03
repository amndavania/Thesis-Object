<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ukt\UktCreateRequest;
use App\Http\Requests\Ukt\UktUpdateRequest;
use App\Models\ExamCard;
use App\Models\Student;
use App\Models\StudentType;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\Ukt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        $semester = $request->semester;
        $payment_type = $request->type;
        $amount = $request->amount;

        //Get student and student type
        $student_type = $this->getStudentType($request->students_id);

        //Add Transaction on debit
        $student = Student::where('id', $request->students_id)->first();
        $user_id = $request->user()->id;
        $description = "Pembayaran " . $request->type . " " . $student->nim . " " . $student->name;
        $reference_number = $request->reference_number;
        $amount = $request->amount;
        $type = "debit";
        $transaction_accounts_id = 1130;

        $this->addTransaction($user_id, $description, $reference_number, $amount, $type, $transaction_accounts_id);
        $latestTransaction = Transaction::latest('id')->first();
        $request['transaction_debit_id'] = $latestTransaction->id;
        $this->updateTransactionAccount($transaction_accounts_id);

        //Add Transaction on kredit
        $description = "Pendapatan " . $request->type . " " . $student->nim . " " . $student->name;
        $amount = $request->amount;
        $type = "kredit";
        $transaction_accounts_id = 1120;

        $this->addTransaction($user_id, $description, $reference_number, $amount, $type, $transaction_accounts_id);
        $latestTransaction = Transaction::latest('id')->first();
        $request['transaction_kredit_id'] = $latestTransaction->id;

        $this->updateTransactionAccount($transaction_accounts_id);

        $request['total'] = 0;
        $request['status'] = '-';
        $request['transaction_accounts_id'] = 1130;
        Ukt::create($request->all());

        //Set total and payment status
        $setTotalStatus = $this->setTotalStatus($student_id, $semester, $payment_type, $student_type);
        $payment = Ukt::latest()->first();
        $payment->total = $setTotalStatus[0];
        $payment->status = $setTotalStatus[1];

        //Set keterangan

        $currentYear = date('Y');

        if ($payment_type == "UKT") {
            $ukt = Ukt::where('students_id', $student_id)
                ->where('semester', $semester)
                ->where('type', $payment_type)->get();
            if ($setTotalStatus[1] == "Lunas") {
                $payment->keterangan = 'ALL';
                $exam_uts = ExamCard::where('students_id', $student_id)->where('semester', $semester)->where('type', "UTS")->exists();
                $exam_uas = ExamCard::where('students_id', $student_id)->where('semester', $semester)->where('type', "UAS")->exists();
                if (!$exam_uts && !$exam_uas) {
                    $payment->exam_uts_id = $this->createExamCard($student_id, "UTS", $semester, $currentYear);
                    $payment->exam_uas_id = $this->createExamCard($student_id, "UAS", $semester, $currentYear);
                }elseif (!$exam_uas && $exam_uts) {
                    $payment->exam_uas_id = $this->createExamCard($student_id, "UAS", $semester, $currentYear);
                }elseif (!$exam_uts && $exam_uas) {
                    $payment->exam_uts_id = $this->createExamCard($student_id, "UTS", $semester, $currentYear);
                }
            } elseif ($setTotalStatus[1] == "Belum Lunas") {
                if ($ukt->sum('amount') >= ( $student_type->krs + $student_type->uts )) {
                    $card = ExamCard::where('students_id', $student_id)
                        ->where('semester', $semester)->where('type', "UTS")->exists();
                    if (empty($card)) {
                        $payment->keterangan = 'UTS';
                        $payment->exam_uts_id = $this->createExamCard($student_id, "UTS", $semester, $currentYear);
                    } else{
                        $payment->keterangan = 'Menunggu Dispensasi UAS';
                    }
                } elseif ($ukt->sum('amount') >= $student_type->krs) {
                    $card = Ukt::where('students_id', $student_id)
                        ->where('semester', $semester)->where('keterangan', "KRS")->exists();
                    if (empty($card)) {
                        $payment->keterangan = 'KRS';
                    } else {
                        $payment->keterangan = 'Menunggu Dispensasi UTS';
                    }
                }
            }
        }

        $payment->save();



        // Ukt::create($request->all());

        return redirect()->route('ukt.index')->with(['success' => 'Data berhasil disimpan']);
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

    public function setStatus($amount, $total)
    {
        if ($amount < $total) {
            $status = 'Belum Lunas';
        }elseif ($amount == $total) {
            $status = 'Lunas';
        }elseif ($amount > $total) {
            $status = 'Kelebihan Bayar';
        }

        return $status;
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
        $account->fill(['balance' => $ammount]);

        $account->save();
    }

    public function getStudentType($student_id)
    {
        $student = Student::where('id', $student_id)->first();
        $student_type = StudentType::where('id', $student->student_types_id)->first();

        return $student_type;
    }

    public function setTotalStatus($student_id, $semester, $payment_type, $student_type)
    {
        $payment = Ukt::where('students_id', $student_id)
            ->where('semester', $semester)
            ->where('type', $payment_type)->get();

        if ($payment_type == 'DPP') {
            $total = $student_type->dpp;
            $dpp = Ukt::where('students_id', $student_id)->whereIn('semester', [1, 2])
                ->where('type', $payment_type)->get();
            $status = $this->setStatus(($dpp->sum('amount')), $total);
        } elseif ($payment_type == 'UKT') {
            $total = $student_type->krs + $student_type->uts + $student_type->uas;
            $status = $this->setStatus(($payment->sum('amount')), $total);
        } elseif ($payment_type == 'WISUDA') {
            $total = $student_type->wisuda;
            $status = $this->setStatus(($payment->sum('amount')), $total);
        }

        return [$total, $status];
    }

    public static function createExamCard($student_id, $type, $semester, $year)
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

    public function deleteExamCard($exam_id)
    {
        $exam = ExamCard::where('id', $exam_id)->first();
        if (!empty($exam)) {
            $exam->delete();
        }
    }
}
