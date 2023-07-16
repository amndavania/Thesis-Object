<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\TransactionCreateRequest;
use App\Http\Requests\Transaction\TransactionUpdateRequest;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\Ukt;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transaction.data')->with([
            'transaction' => Transaction::latest()->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transaction_account = TransactionAccount::all();
        return view('transaction.create', compact('transaction_account'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionCreateRequest $request)
    {
        $request['user_id'] = $request->user()->id;
        Transaction::create($request->all());

        $this->updateTransactionAccount($request->transaction_accounts_id, $request->type, $request->amount);

        return redirect()->route('transaction.index')->with(['success' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $ukt_debit = Ukt::where('transaction_debit_id', $id)->exists();
        $ukt_kredit = Ukt::where('transaction_kredit_id', $id)->exists();

        if ($ukt_debit || $ukt_kredit) {
            return redirect()->route('transaction.index')->with(['warning' => 'Mohon edit melalui menu Pembayaran Mahasiswa']);
        } else {
            return view('transaction.edit')->with([
                'transaction' => Transaction::findOrFail($id),
                'transaction_account' => TransactionAccount::all(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionUpdateRequest $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $request['transaction_accounts_id'] = $transaction->transaction_accounts_id;
        $oldAmount = $transaction->amount;
        $newAmount = $request->amount;
        $amount = $newAmount - $oldAmount;
        $transaction->update($request->all());

        $this->updateTransactionAccount($request->transaction_accounts_id, $request->type, $amount);

        return redirect()->route('transaction.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::where('id', $id)->first();

        $ukt_debit = Ukt::where('transaction_debit_id', $id)->exists();
        $ukt_kredit = Ukt::where('transaction_kredit_id', $id)->exists();

        if (!$ukt_debit && !$ukt_kredit) {
            $transactions = Transaction::findOrFail($id);
            $amount = $transaction->amount;
            $this->updateTransactionAccount($transaction->transaction_accounts_id, $transaction->type, -$amount);
            $transactions->delete();

            return redirect()->route('transaction.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('transaction.index')->with(['warning' => 'Mohon hapus melalui menu Pembayaran Mahasiswa']);
        }

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
}
