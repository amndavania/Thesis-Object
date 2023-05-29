<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentType;
use App\Models\StudyProgram;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Student\StudentCreateRequest;
use App\Http\Requests\Student\StudentUpdateRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        return view('student.data')->with([
            'student' => Student::paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        $study_program = StudyProgram::all();
        $student_type = StudentType::all();
        // return view('student.create')->with([
        //     "study_program" => StudyProgram::all(),
        //     "student_type" => StudentType::all(),
        // ]);
        return view('student.create', compact('study_program', 'student_type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentCreateRequest $request):RedirectResponse
    {

        Student::create($request->all());
        return redirect()->route('student.index')->with(['success' => 'Data berhasil disimpan']);
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
        return view('student.edit')->with([
            'student' => Student::findOrFail($id),
            "study_program" => StudyProgram::all(),
            "student_type" => StudentType::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, string $id):RedirectResponse
    {

        $student = Student::findOrFail($id);
        $student->update($request->all());
        return redirect()->route('student.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id):RedirectResponse
    {
        //
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('student.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
