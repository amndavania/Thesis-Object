<?php

namespace App\Http\Controllers;

use App\Models\AccountingGroup;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
    public function store(Request $request)
    {
        //
        $input = $request->validate([
            'id'=>'required',
            'name'=>'required',
            'description' => 'required'
        ]);
        AccountingGroup::create($input);
        
        return redirect()->route('accounting_group.index')->with(['success' => 'Data telah disimpan']);
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
    public function update(Request $request, string $id):RedirectResponse
    {
        //
        $input = $request->validate([
            'id'=>'required',
            'name'=>'required',
            'description'=>'required',
        ]);

        $accounting_group = AccountingGroup::findOrFail($id);
        $accounting_group->update($input);
        return redirect()->route('accounting_group.index')->with(['success' => 'Data telah disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id):RedirectResponse
    {
        AccountingGroup::destroy($id);
        return redirect()->route('accounting_group.index')->with(['success' => 'Data telah disimpan']);
    }
}
