<?php

namespace App\Http\Controllers;

use App\Models\Dpa;
use App\Models\Report;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengguna.data', [
            'user' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return red
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $report = Report::where('user_id', $id)->exists();
        $transaction = Transaction::where('user_id', $id)->exists();


        if (!$report && !$transaction) {
            $user = User::findOrFail($id);
            $data_dpa = Dpa::where('user_id',$id)->exists();
            $student = Student::where('dpa_id', $id)->exists();
            if ($data_dpa && !$student) {
                $dpa = Dpa::where('user_id',$id);
                $dpa->delete();
            } else if ($student) {
                return redirect()->route('pengguna.index')->with(['warning' => 'Data DPA masih terhubung dengan data Mahasiswa']);
            }
            $user->delete();
            return redirect()->route('pengguna.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('pengguna.index')->with(['warning' => 'Data pengguna masih terhubung dengan data Laporan dan Transaksi']);
        }
    }
}
