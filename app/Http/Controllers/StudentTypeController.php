<?php

namespace App\Http\Controllers;

use App\Models\StudentType;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StudentType\StudentTypeCreateRequest;
use App\Http\Requests\StudentType\StudentTypeUpdateRequest;

class StudentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        return view('student_type.data')->with([
            'student_type' => StudentType::paginate(20),
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
    public function store(StudentTypeCreateRequest $request):RedirectResponse
    {

        StudentType::create($request->all());
        return redirect()->route('student_type.index')->with(['success' => 'Data berhasil disimpan']);
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
        $student_type = StudentType::findOrFail($id);
        return view('student_type.edit', compact('student_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentTypeUpdateRequest $request, string $id):RedirectResponse
    {

        $student_type = StudentType::findOrFail($id);
        $student_type->update($request->all());
        return redirect()->route('student_type.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id):RedirectResponse
    {
        //
        $student_type = StudentType::findOrFail($id);
        $student_type->delete();

        return redirect()->route('student_type.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
