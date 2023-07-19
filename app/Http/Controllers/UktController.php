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
use Illuminate\Http\RedirectResponse;

class UktController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ukt.data')->with([
            'ukt' => Ukt::latest()->paginate(20),
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
     * Remove the specified resource from storage.
     */
    public function destroy(String $id):RedirectResponse
    {
        $ukt = Ukt::findOrFail($id);

        $this->deleteTransaction($ukt->transaction_debit_id);
        $this->deleteTransaction($ukt->transaction_kredit_id);

        $this->deleteExamCard($ukt->exam_uts_id);
        $this->deleteExamCard($ukt->exam_uas_id);

        $this->deleteBimbinganStudi($ukt->lbs_id);

        $this->updateTransactionAccount(1120, 'kredit', -$ukt->amount);
        $this->updateTransactionAccount(1130, 'debit', -$ukt->amount);

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

    public function deleteTransaction($transaction_id)
    {

        $transaction = Transaction::where('id', $transaction_id)->first();
        $transaction->delete();

    }

    public function updateTransactionAccount($transaction_accounts_id, $type, $amount)
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
            $dpp = Ukt::where('students_id', $student_id)->where('year', $year)
                ->where('type', $payment_type)->get();
            $status = $this->setStatus(($dpp->sum('amount') + $nominal), $payment_type, $student_type);
        } elseif ($payment_type == 'UKT') {
            $status = $this->setStatus($totalPayment, $payment_type, $student_type);
        } elseif ($payment_type == 'WISUDA') {
            $status = $this->setStatus($totalPayment, $payment_type, $student_type);
        }

        return $status;
    }

    public function setStatus($amount, $payment_type, $student_type)
    {
        // dd($student_type);
        if ($payment_type == 'UKT') {
            $totalKRS = floatval($student_type->krs);
            $totalUTS = $totalKRS + $student_type->uts;
            $totalUAS = $totalUTS + $student_type->uas;

            // dd([$totalUAS, $totalUTS, $totalKRS, $amount]);

            if ($amount > $totalUAS) {
                $status = 'Lebih';
            } elseif ($amount == $totalUAS) {
                $status = 'Lunas';
            } elseif ($amount >= $totalUTS) {
                $status = 'Lunas UTS';
            } elseif ($amount >= $totalKRS) {
                $status = 'Lunas KRS';
            } else {
                $status = 'Belum Lunas';
            }

            // dd([$amount, $totalKRS, $totalUTS, $totalUAS, $status]);

        } elseif ($payment_type == 'DPP') {
            if ($amount < $student_type->dpp) {
                $status = 'Belum Lunas';
            }elseif ($amount == $student_type->dpp) {
                $status = 'Lunas';
            }elseif ($amount > $student_type->dpp) {
                $status = 'Lebih';
            }
        } elseif ($payment_type == 'WISUDA') {
            if ($amount < $student_type->wisuda) {
                $status = 'Belum Lunas';
            }elseif ($amount == $student_type->wisuda) {
                $status = 'Lunas';
            }elseif ($amount > $student_type->wisuda) {
                $status = 'Lebih';
            }
        }

        return $status;
    }

    public function setKeterangan($studentData, $year, $semester, $payment_type, $status)
    {
        $payment = Ukt::latest()->first();

        if ($payment_type == "UKT") {
            // $ukt = Ukt::where('students_id', $studentData[0]->id)
            //     ->where('year', $year)
            //     ->where('semester', $semester)
            //     ->where('type', $payment_type)->get();

            // $totalKRS = $studentData[1]->krs;
            // $totalUTS = $totalKRS + $studentData[1]->uts;
            // $totalPayment = $ukt->sum('amount');

            $bimbinganStudy = BimbinganStudy::where('students_id', $studentData[0]->id)
                    ->where('year', $year)->where('semester', $semester)->exists();

            if ($status == "Lunas") {
                if (!$bimbinganStudy) {
                    // $payment->keterangan = 'UAS';
                    $payment->lbs_id = $this->createBimbinganStudy($studentData[0]->id, $year, $semester);
                } else {
                    // $payment->keterangan = 'UAS';
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
                }
            } elseif ($status == "Lunas UTS") {
                if (!$bimbinganStudy) {
                    // $payment->keterangan = 'UTS';
                    $payment->lbs_id = $this->createBimbinganStudy($studentData[0]->id, $year, $semester);
                } else {
                    $card = ExamCard::where('students_id', $studentData[0]->id)
                        ->where('semester', $semester)->where('type', "UTS")->exists();
                    if (!$card) {
                        // $payment->keterangan = 'UTS';
                        $payment->exam_uts_id = $this->createExamCard($studentData[0]->id, "UTS", $semester, $year);
                    } else{
                        $payment->keterangan = 'Menunggu Dispensasi UAS';
                    }
                }
            } elseif ($status == "Lunas KRS") {
                if (!$bimbinganStudy) {
                    // $payment->keterangan = 'KRS';
                    $payment->lbs_id = $this->createBimbinganStudy($studentData[0]->id, $year, $semester);
                } else {
                    $krs = Ukt::where('students_id', $studentData[0]->id)
                        ->where('semester', $semester)->where('status', "Lunas KRS")->exists();
                    if ($krs) {
                        $payment->keterangan = 'Menunggu Dispensasi UTS';
                        // $payment->keterangan = 'KRS';
                    } else {
                        // $payment->keterangan = 'Menunggu Dispensasi UTS';
                    }
                }
            }elseif ($status == "Belum Lunas") {
                $payment->keterangan = 'Menunggu Dispensasi KRS';
                // if ($totalPayment >= $totalUTS) {

                // } elseif ($totalPayment >= $totalKRS) {

                // } elseif ($totalPayment < $totalKRS) {

                // }
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

    public function deleteBimbinganStudi($lbs_id)
    {
        $bimbinganStudy = BimbinganStudy::where('id', $lbs_id)->first();
        if (!empty($bimbinganStudy)) {
            $bimbinganStudy->delete();
        }
    }
}
