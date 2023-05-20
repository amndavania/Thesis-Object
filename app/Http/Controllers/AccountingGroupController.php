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
    public function store(Request $request):RedirectResponse
    {
        //
        $this->validate($request,[
            'name'=>'required|min:5',
        ]);

        // AccountingGroup::create($request->all());
        AccountingGroup::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        // DB::table('accounting_group')->insert($request->all());
        // DB::table('accounting_group')->insert(
        //     [
        //         'name' => $request->name,
        //     ]
        // );

        // $accounting_group = new AccountingGroup;
        // $accounting_group->name=$request->name;
        // $accounting_group->save();

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
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request,[
            'name'=>'required|min:5',
        ]);

        $accounting_group = AccountingGroup::findOrFail($id);
        $accounting_group->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('accounting_group.index')->with(['success' => 'Data telah disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id):RedirectResponse
    {
        //
        $accounting_group = AccountingGroup::findOrFail($id);
        $accounting_group->delete();

        return redirect()->route('accounting_group.index')->with(['success' => 'Data telah disimpan']);
    }
}
