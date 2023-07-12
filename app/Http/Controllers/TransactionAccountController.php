<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionAccount\TransactionAccountCreateRequest;
use App\Http\Requests\TransactionAccount\TransactionAccountUpdateRequest;
use App\Models\AccountingGroup;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        return view('transaction_account.data')->with([
            'transaction_account' => TransactionAccount::latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        $accounting_group = AccountingGroup::all();
        return view('transaction_account.create',  compact('accounting_group'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionAccountCreateRequest $request)
    {
        $request['balance'] = 0;
        $transactionAccount = TransactionAccount::create($request->except('accounting_group_id'));
        $accountingGroupIds = $request->input('accounting_group_id', []);

        if (!empty($accountingGroupIds)) {
            $transactionAccount->accountinggroup()->sync($accountingGroupIds);
        }

        return redirect()->route('transaction_account.index')->with(['success' => 'Data berhasil Disimpan']);
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
    public function edit(string $id):View
    {
        //
        $transaction_account = TransactionAccount::findOrFail($id);
        $accounting_group = AccountingGroup::all();
        return view('transaction_account.edit',compact('transaction_account', 'accounting_group'));
    }

    /**
     * Update the specified resource in storage.
     */
    // controller
    public function update(TransactionAccountUpdateRequest $request, string $id): RedirectResponse
    {
        $transactionAccount = TransactionAccount::findOrFail($id);

        $transactionAccount->update($request->except('accounting_group_id'));

        $accountingGroupIds = $request->input('accounting_group_id', []);

        if (!empty($accountingGroupIds)) {
            $transactionAccount->accountinggroup()->sync($accountingGroupIds);
        }

        return redirect()->route('transaction_account.index')->with(['success' => 'Data berhasil diupdate']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id):RedirectResponse
    {
        $transaction = Transaction::where('transaction_accounts_id', $id)->exists();

        if ($id == 1130 || $id == 1120) {
            return redirect()->route('transaction_account.index')->with(['warning' => 'Akun Transaksi tidak dapat dihapus']);
        } elseif (!$transaction) {
            $transaction_account = TransactionAccount::findOrFail($id);
            $transaction_account->delete();
            return redirect()->route('transaction_account.index')->with(['success' => 'Data berhasil dihapus']);
        } else{
            return redirect()->route('transaction_account.index')->with(['warning' => 'Akun Transaksi sedang dipakai di Data Transaksi']);
        }
    }
}
