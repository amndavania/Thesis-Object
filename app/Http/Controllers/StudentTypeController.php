<?php

namespace App\Http\Controllers;

use App\Models\StudentType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StudentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        return view('student_type.data')->with([
            'student_type' => StudentType::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        return view('student_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $input = $request->validate([
            'type'=>'required',
            'dpp'=>'required',
            'krs'=>'required',
            'uts'=>'required',
            'uas'=>'required',
            'wisuda'=>'required',
        ]);

        StudentType::create($input);

        return redirect()->route('student_type.index')->with(['success' => 'Data telah disimpan']);
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
        return view('student_type.edit')->with([
            'student_type' => StudentType::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):RedirectResponse
    {
        //
        $input = $request->validate([
            'type'=>'required',
            'dpp'=>'required',
            'krs'=>'required',
            'uts'=>'required',
            'uas'=>'required',
            'wisuda'=>'required',
        ]);
        
        $student_type = StudentType::findOrFail($id);
        $student_type->update($input);

        return redirect()->route('student_type.index')->with(['success' => 'Data telah disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id):RedirectResponse
    {
        //
        $student_type = StudentType::findOrFail($id);
        $student_type->delete();

        return redirect()->route('student_type.index')->with(['success' => 'Data telah disimpan']);
    }
}
