<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionAccount;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pemasukan.data')->with([
            'pemasukan' => Transaction::where('type','debit')->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transaction_account = TransactionAccount::all();
        return view('pemasukan.create', compact('transaction_account'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['user_id'] = $request->user()->id;
        $request['type'] = 'debit';
        Transaction::create($request->all());
        return redirect()->route('pemasukan.index')->with(['success' => 'Data berhasil disimpan']);
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
        return view('pemasukan.edit')->with([
            'pemasukan' => Transaction::findOrFail($id),
            "transaction_account" => TransactionAccount::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pemasukan = Transaction::findOrFail($id);
        $pemasukan->update($request->all());
        return redirect()->route('pemasukan.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemasukan = Transaction::findOrFail($id);
        $pemasukan->delete();
        return redirect()->route('pemasukan.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
