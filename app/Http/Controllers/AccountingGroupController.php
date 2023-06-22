<?php

namespace App\Http\Controllers;

use App\Models\AccountingGroup;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Accounting\AccountingGroupCreateRequest;
use App\Http\Requests\Accounting\AccountingGroupUpdateRequest;
use App\Models\TransactionAccount;

class AccountingGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        return view('accounting_group.data')->with([
            'accounting_group' => AccountingGroup::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        return view('accounting_group.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountingGroupCreateRequest $request)
    {
        AccountingGroup::create($request->all());

        return redirect()->route('accounting_group.index')->with(['success' => 'Data berhasil Disimpan']);
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
    // public function edit(string $id):View
    // {
    //     //
    //     $accounting_group = AccountingGroup::findOrFail($id);
    //     return view('accounting_group.edit',compact('accounting_group'));
    // }

    /**
     * Update the specified resource in storage.
     */
    // controller
    // public function update(AccountingGroupUpdateRequest $request, string $id):RedirectResponse
    // {
    //     $accounting_group = AccountingGroup::findOrFail($id);
    //     $accounting_group->update($request->all());
    //     return redirect()->route('accounting_group.index')->with(['success' => 'Data berhasil diupdate']);
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id):RedirectResponse
    // {
    //     $transaction_account = TransactionAccount::where('accounting_group_id', $id)->exists();

    //     if (!$transaction_account) {
    //         $accounting_group = AccountingGroup::findOrFail($id);
    //         $accounting_group->delete();
    //         return redirect()->route('accounting_group.index')->with(['success' => 'Data telah dihapus']);
    //     } else {
    //         return redirect()->route('accounting_group.index')->with(['warning' => 'Grup Akun Transaksi sedang dipakai di Akun Transaksi']);
    //     }
    // }
}
