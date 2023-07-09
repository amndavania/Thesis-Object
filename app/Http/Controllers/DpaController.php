<?php

namespace App\Http\Controllers;

use App\Models\Dpa;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StudentType;
use App\Models\StudyProgram;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\dpa\DpaCreateRequest;
use App\Http\Requests\dpa\DpaUpdateRequest;
use App\Models\Ukt;

class DpaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('dpa.data')->with([
            'dpa' => Dpa::latest()->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('dpa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DpaCreateRequest $request):RedirectResponse
    {
        
        // Simpan akun user DPA
        $name = $request->name;
        $email = $request->email;
        $password = bcrypt('admin');
        $role = 'DPA';
        $this->addUser($name, $email, $password, $role);

        // Simpan data DPA
        $user_id = User::where('name', $name)->first();
        Dpa::create([
            'name' => $name,
            'email' => $email,
            'user_id' => $user_id['id'],
        ]);

        return redirect()->route('dpa.index')->with(['success' => 'Data berhasil disimpan']);
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
        return view('dpa.edit')->with([
            'dpa' => Dpa::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DpaUpdateRequest $request, string $id):RedirectResponse
    {
        $dpa = Dpa::findOrFail($id);
        $dpa->update($request->all());

        $name = $request->name;
        $email = $request->email;

        $user_id = $dpa['user_id'];
        $user = User::findOrFail($user_id);
        $user->update([
            'name' => $name,
            'email' => $email,
        ]);
        
        return redirect()->route('dpa.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dpa = Dpa::findOrFail($id);
        $user_id = $dpa['user_id'];
        $user = User::findOrFail($user_id);
        $dpa->delete();
        $user->delete();
    }

    public function addUser($name, $email, $password, $role)
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ]);
    }

    public function getMahasiswa():View
    {
        return view('dpa.daftarmahasiswa')->with([
            'data' => Dpa::paginate(30),
        ]);
    }
}
