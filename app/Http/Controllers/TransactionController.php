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
            'transaction' => Transaction::paginate(20),
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

        $this->updateTransactionAccount($request->transaction_accounts_id, $request->type);

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
    public function edit(string $id)
    {
        return view('transaction.edit')->with([
            'transaction' => Transaction::findOrFail($id),
            'transaction_account' => TransactionAccount::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionUpdateRequest $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $request['transaction_accounts_id'] = $transaction->transaction_accounts_id;        
        $transaction->update($request->all());

        $this->updateTransactionAccount($request->transaction_accounts_id, $request->type);

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
            $transactions->delete();
            $this->updateTransactionAccount($transaction->transaction_accounts_id);

            return redirect()->route('transaction.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('transaction.index')->with(['warning' => 'Mohon hapus melalui menu Pembayaran Mahasiswa']);
        }

    }

    public function updateTransactionAccount($transaction_accounts_id)
    {
        $transactions = Transaction::where('transaction_accounts_id', $transaction_accounts_id)->get();

        if (empty($transactions)){
            $total_debit = 0;
            $total_kredit = 0;
        }else {
            $total_debit = $transactions->where('type', 'debit')->sum('amount');
            $total_kredit = $transactions->where('type', 'kredit')->sum('amount');            
        }

        $account = TransactionAccount::findOrFail($transaction_accounts_id);
        $account->fill(['ammount_debit' => $total_debit]);
        $account->fill(['ammount_kredit' => $total_kredit]);

        $account->save();
    }
}
