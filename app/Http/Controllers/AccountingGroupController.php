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
}
