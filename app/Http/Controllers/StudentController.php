<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Student;
use App\Models\StudentType;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        return view('student.data')->with([
            'student' => Student::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //

        return view('student.create')->with([
            "study_program" => StudyProgram::all(),
            "student_type" => StudentType::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $input = $request->validate([
            'name'=>'required',
            'nim'=>'required',
            'force'=>'required',
            'study_program'=>'required',
            'student_type'=>'required',
        ]);
        // dd($request);
        Student::create([
            'name'=>$input['name'],
            'nim'=>$input['nim'],
            'force'=>$input['force'],
            'study_program_id'=>$input['study_program'],
            'student_types_id'=>$input['student_type'],
        ]);

        return redirect()->route('student.index')->with(['success' => 'Data telah disimpan']);
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
    public function update(Request $request, string $id):RedirectResponse
    {
        //
        $input = $request->validate([
            'name'=>'required',
            'nim'=>'required',
            'force'=>'required',
            'study_program'=>'required',
            'student_type'=>'required',
        ]);
        
        $student = Student::findOrFail($id);
        $student->update([
            'name' => $input['name'],
            'nim' => $input['nim'],
            'force' => $input['force'],
            'study_program_id' => $input['study_program'],
            'student_types_id' => $input['student_type'],
        ]);

        return redirect()->route('student.index')->with(['success' => 'Data telah disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id):RedirectResponse
    {
        //
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('student.index')->with(['success' => 'Data telah disimpan']);
    }
}
