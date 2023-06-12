<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\TransactionCreateRequest;
use App\Http\Requests\Transaction\TransactionUpdateRequest;
use App\Models\Transaction;
use App\Models\TransactionAccount;

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

        $account = TransactionAccount::findOrFail($request->transaction_accounts_id);
        if ($request->type == 'debit') {
            $account->fill(['ammount_debit' => $account->ammount_debit + $request->amount]);
        }else{
            $account->fill(['ammount_kredit' => $account->ammount_kredit + $request->amount]);
        }
        $account->save();

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
        $request['amount'] = $transaction->amount;
        $request['type'] = $transaction->type;
        $request['transaction_accounts_id'] = $transaction->transaction_accounts_id;        
        $transaction->update($request->all());

        return redirect()->route('transaction.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $transaction = Transaction::where('id', $id)->first();
        $amount = $transaction->amount;
        $transaction_account_id = $transaction->transaction_accounts_id;

        $account = TransactionAccount::findOrFail($transaction_account_id);
        if ($transaction->type == 'debit') {
            $account->fill(['ammount_debit' => $account->ammount_debit - $amount]);
        }else{
            $account->fill(['ammount_kredit' => $account->ammount_kredit - $amount]);
        }

        $account->save();

        $pemasukan = Transaction::findOrFail($id);
        $pemasukan->delete();

        return redirect()->route('transaction.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
