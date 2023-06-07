<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ukt\UktCreateRequest;
use App\Http\Requests\Ukt\UktUpdateRequest;
use App\Models\Student;
use App\Models\TransactionAccount;
use App\Models\Ukt;
use Illuminate\Http\RedirectResponse;

class UktController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ukt.data')->with([
            'ukt' => Ukt::paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student = Student::all();
        $transaction_account = TransactionAccount::all();
        return view('ukt.create', compact('student', 'transaction_account'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UktCreateRequest $request)
    {
        Ukt::create($request->all());
        return redirect()->route('pemasukan.index')->with(['success' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ukt $ukt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        return view('ukt.edit')->with([
            'ukt' => Ukt::findOrFail($id),
            'transaction_account' => TransactionAccount::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UktUpdateRequest $request, String $id):RedirectResponse
    {
        $ukt = Ukt::findOrFail($id);
        $request['students_id'] = $ukt->students_id;
        $ukt->update($request->all());
        return redirect()->route('ukt.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id):RedirectResponse
    {
        $ukt = Ukt::findOrFail($id);
        $ukt->delete();

        return redirect()->route('ukt.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
