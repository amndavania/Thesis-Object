<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $student_id = $this->route('student');

        return [
            'name'=>'required',
            'nim'=>'required|numeric|unique:students,nim,'.$student_id,
            'force'=>'required|numeric',
            'study_program_id'=>'required',
            'student_types_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Nama mahasiswa harus diisi',
            'nim.required'=>'NIM harus diisi',
            'nim.numeric'=>'NIM harus berupa angka',
            'force.required'=>'Tahun masuk harus diisi',
            'force.numeric'=>'Tahun masuk harus berupa angka',
            'study_program_id.required'=>'Program Studi harus diisi',
            'student_types_id.required'=>'Jenis Beasiswa harus diisi',
        ];
    }
}
