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
    public function index():View //
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
    
    public function setStatus($amount, $payment_type, $student_type) //this, the student_type parameter's declared in the getStudentData line 184 S1
    {
        if ($payment_type == 'UKT') { //S2 //ini untuk yang ukt
            $status = $this->uktPaymentStatus($amount,$student_type);
        } elseif ($payment_type == 'DPP') { //s15 //ini untuk dpp
            $status = $this->dppPaymentStatus($amount,$student_type);
        } elseif ($payment_type == 'WISUDA') { //s22 //ini untuk wisuda
            $status = $this->wisudaPaymentStatus($amount,$student_type);
        }
        return $status; //s29
    }

    private function uktPaymentStatus($amount, $student_type)
    {
        $totalKRS = floatval($student_type->krs); //s3
        $totalUTS = $totalKRS + $student_type->uts; //s4
        $totalUAS = $totalUTS + $student_type->uas; //s5

        // dd([$totalUAS, $totalUTS, $totalKRS, $amount]);

        if ($amount > $totalUAS) { //s6
            $status = 'Lebih'; //s7
        } elseif ($amount == $totalUAS) { //s8
            $status = 'Lunas'; //s9
        } elseif ($amount >= $totalUTS) { //s10
            $status = 'Lunas UTS'; //s11
        } elseif ($amount >= $totalKRS) { //s12
            $status = 'Lunas KRS'; //s13
        } else {
            $status = 'Belum Lunas'; //s14
        }
        return $status;
    }

    private function dppPaymentStatus($amount, $student_type)
    {
        if ($amount < $student_type->dpp) { //s16
            $status = 'Belum Lunas'; //s17
        }elseif ($amount == $student_type->dpp) { //s18
            $status = 'Lunas'; //s19
        }elseif ($amount > $student_type->dpp) { //s20
            $status = 'Lebih'; //s21
        }
        return $status; //s29
    }

    private function wisudaPaymentStatus($amount, $student_type)
    {
        if ($amount < $student_type->wisuda) { //s23
            $status = 'Belum Lunas'; //s24
        }elseif ($amount == $student_type->wisuda) { //s25
            $status = 'Lunas'; //s26
        }elseif ($amount > $student_type->wisuda) { //s27
            $status = 'Lebih'; //s28
        }
        return $status; //s29
    }
}
