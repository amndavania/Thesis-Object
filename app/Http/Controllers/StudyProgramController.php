<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Study\StudyProgramCreateRequest;
use App\Http\Requests\Study\StudyProgramUpdateRequest;

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
    public function store(StudyProgramCreateRequest $request):RedirectResponse
    {

        StudyProgram::create($request->all());

        return redirect()->route('study_program.index')->with(['success' => 'Data berhasil disimpan']);
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
    public function update(StudyProgramUpdateRequest $request, string $id):RedirectResponse
    {
        
        $study_program = StudyProgram::findOrFail($id);
        $study_program->update($request->all());
        return redirect()->route('study_program.index')->with(['success' => 'Data berhasil diupdate']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id):RedirectResponse
    {
        //
        $study_program = StudyProgram::findOrFail($id);
        $study_program->delete();

        return redirect()->route('study_program.index')->with(['success' => 'Data telah dihapus']);
    }
}
