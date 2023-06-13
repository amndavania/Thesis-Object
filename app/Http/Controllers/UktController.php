<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ukt\UktCreateRequest;
use App\Http\Requests\Ukt\UktUpdateRequest;
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

        //Get student and student type
        $student_id = $request->students_id;
        $student = Student::where('id', $student_id)->first();
        $student_type = StudentType::where('year', $student->force)
            ->where('study_program_id', $student->study_program_id)->first();

        //Add up all bills
        $total = $student_type->dpp + $student_type->krs + $student_type->uts + $student_type->uas + $student_type->wisuda;
        $request['total'] = $total;
        $request['transaction_accounts_id'] = 1130;

        //Add Transaction on debit
        $user_id = $request->user()->id;
        $description = "Pembayaran " . $student->nim . " " . $student->name;
        $reference_number = $request->reference_number;
        $amount = $request->amount;
        $type = "debit";
        $transaction_accounts_id = 1130;

        Transaction::create([
            'user_id' => $user_id,
            'description' => $description,
            'reference_number' => $reference_number,
            'amount' => $amount,
            'type' => $type,
            'transaction_accounts_id' => $transaction_accounts_id
        ]);

        //Add Transaction on kredit
        $description = "Pendapatan " . $student->nim . " " . $student->name;
        $amount = $request->amount;
        $type = "kredit";
        $transaction_accounts_id = 1120;

        Transaction::create([
            'user_id' => $user_id,
            'description' => $description,
            'reference_number' => $reference_number,
            'amount' => $amount,
            'type' => $type,
            'transaction_accounts_id' => $transaction_accounts_id
        ]);

        Ukt::create($request->all());

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
    public function edit(String $id)
    {
        return view('ukt.edit')->with([
            'ukt' => Ukt::findOrFail($id),
            'transaction_account' => TransactionAccount::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UktUpdateRequest $request, String $id):RedirectResponse
    {
        $ukt = Ukt::findOrFail($id);
        $request['students_id'] = $ukt->students_id;
        $ukt->update($request->all());
        return redirect()->route('ukt.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id):RedirectResponse
    {
        $ukt = Ukt::findOrFail($id);
        $ukt->delete();

        return redirect()->route('ukt.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
