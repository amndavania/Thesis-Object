<?php

namespace App\Http\Controllers;

use App\Models\StudentType;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StudentType\StudentTypeCreateRequest;
use App\Http\Requests\StudentType\StudentTypeUpdateRequest;
use App\Models\StudyProgram;

class StudentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        return view('student_type.data')->with([
            'student_type' => StudentType::latest()->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $study_program = StudyProgram::all();
        return view('student_type.create', compact('study_program'));
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
        return view('student_type.edit')->with([
            'student_type' => StudentType::findOrFail($id),
            'study_program' => StudyProgram::all(),
        ]);
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

        $student = Student::where('student_types_id', $id)->exists();

        if (!$student) {
            $student_type = StudentType::findOrFail($id);
            $student_type->delete();
            return redirect()->route('student_type.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('student_type.index')->with(['warning' => 'Beasiswa masih terhubung dengan Mahasiswa']);
        }
    }

    //this, the student_type parameter's declared in the getStudentData line 184 S1
    public function setStatus($amount, $payment_type, $student_type) 
    {
        if ($payment_type == 'UKT') {
            $status = $this->uktPaymentStatus($amount,$student_type);
        } elseif ($payment_type == 'DPP') { 
            $status = $this->dppPaymentStatus($amount,$student_type);
        } elseif ($payment_type == 'WISUDA') {
            $status = $this->wisudaPaymentStatus($amount,$student_type);
        }
        return $status; 
    }

    private function uktPaymentStatus($amount, $student_type)
    {
        $status = null; 
        $totalKRS = floatval($student_type->krs);
        $totalUTS = $totalKRS + $student_type->uts; 
        $totalUAS = $totalUTS + $student_type->uas; 

        if ($amount > $totalUAS) {
            $status = 'Lebih'; 
        } elseif ($amount == $totalUAS) { 
            $status = 'Lunas';
        } elseif ($amount >= $totalUTS) { 
            $status = 'Lunas UTS';
        } elseif ($amount >= $totalKRS) { 
            $status = 'Lunas KRS'; 
        } else {
            $status = 'Belum Lunas';
        }
        return $status;
    }

    private function dppPaymentStatus($amount, $student_type)
    {
        if ($amount < $student_type->dpp) { 
            $status = 'Belum Lunas'; 
        } elseif ($amount == $student_type->dpp) { 
            $status = 'Lunas'; 
        } elseif ($amount > $student_type->dpp) { 
            $status = 'Lebih'; 
        }
    
        return $status; 
    }
    

    private function wisudaPaymentStatus($amount, $student_type)
    {
        if ($amount < $student_type->wisuda) { 
            $status = 'Belum Lunas'; 
        }elseif ($amount == $student_type->wisuda) { 
            $status = 'Lunas'; 
        }elseif ($amount > $student_type->wisuda) { 
            $status = 'Lebih'; 
        }
        return $status; 
    }
}

