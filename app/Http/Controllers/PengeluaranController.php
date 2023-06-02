<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionAccount;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengeluaran.data')->with([
            'pengeluaran' => Transaction::where('type','kredit')->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transaction_account = TransactionAccount::all();
        return view('pengeluaran.create', compact('transaction_account'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['user_id'] = $request->user()->id;
        $request['type'] = 'kredit';
        Transaction::create($request->all());
        return redirect()->route('pengeluaran.index')->with(['success' => 'Data berhasil disimpan']);
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
        return view('pengeluaran.edit')->with([
            'pengeluaran' => Transaction::findOrFail($id),
            "transaction_account" => TransactionAccount::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengeluaran = Transaction::findOrFail($id);
        $pengeluaran->update($request->all());
        return redirect()->route('pengeluaran.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengeluaran = Transaction::findOrFail($id);
        $pengeluaran->delete();
        return redirect()->route('pengeluaran.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
