<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\Faculty\FacultyCreateRequest;
use App\Http\Requests\Faculty\FacultyUpdateRequest;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        return view('faculty.data')->with([
            'faculty' => Faculty::All()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        return view('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FacultyCreateRequest $request)
    {

        Faculty::create($request->all());
        return redirect()->route('faculty.index')->with(['success' => 'Data berhasil disimpan']);
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
        $faculty = Faculty::findOrFail($id);
        return view('faculty.edit',compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacultyUpdateRequest $request, string $id):RedirectResponse
    {

        $faculty = Faculty::findOrFail($id);
        $faculty->update($request->all());
        return redirect()->route('faculty.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id):RedirectResponse
    {
        //
        $study_program = StudyProgram::where('faculty_id', $id)->exists();

        if (!$study_program) {
            $faculty = Faculty::findOrFail($id);
            $faculty->delete();
            return redirect()->route('faculty.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('faculty.index')->with(['warning' => 'Fakultas masih terhubung dengan Program Studi']);
        }
        

        
    }
}
