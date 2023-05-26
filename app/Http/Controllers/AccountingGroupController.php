<?php

namespace App\Http\Controllers;

use App\Models\AccountingGroup;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AccountingGroupCreateRequest;

class AccountingGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        return view('accounting_group.data')->with([
            'accounting_group' => AccountingGroup::All()
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
    public function edit(string $id):View
    {
        //
        $accounting_group = AccountingGroup::findOrFail($id);
        return view('accounting_group.edit',compact('accounting_group'));
    }

    /**
     * Update the specified resource in storage.
     */
    // controller
    public function update(AccountingGroupCreateRequest $request, string $id):RedirectResponse
    {
        $accounting_group = AccountingGroup::findOrFail($id);
        $accounting_group->update($request->all());
        return redirect()->route('accounting_group.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id):RedirectResponse
    {
        AccountingGroup::destroy($id);
        return redirect()->route('accounting_group.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
