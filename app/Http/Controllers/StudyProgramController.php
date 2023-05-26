<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        return view('study_program.data')->with([
            'study_program' => StudyProgram::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        $faculty = Faculty::all();
        return view('study_program.create', compact('faculty'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $input = $request->validate([
            'name'=>'required',
            'fakultas'=>'required',
        ]);

        StudyProgram::create([
            'name' => $input['name'],
            'faculty_id' => $input['fakultas'],
        ]);

        return redirect()->route('study_program.index')->with(['success' => 'Data telah disimpan']);
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
        return view('study_program.edit')->with([
            'study_program' => StudyProgram::findOrFail($id),
            'faculty' => Faculty::All(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):RedirectResponse
    {
        //
        $input = $request->validate([
            'name'=>'required',
            'fakultas'=>'required',
        ]);
        
        $study_program = StudyProgram::findOrFail($id);
        $study_program->update([
            'name' => $input['name'],
            'faculty_id' => $input['fakultas'],
        ]);

        return redirect()->route('study_program.index')->with(['success' => 'Data telah disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id):RedirectResponse
    {
        //
        $study_program = StudyProgram::findOrFail($id);
        $study_program->delete();

        return redirect()->route('study_program.index')->with(['success' => 'Data telah disimpan']);
    }
}
