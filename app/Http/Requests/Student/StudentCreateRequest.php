<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentCreateRequest extends FormRequest
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
        return [
            'name'=>'required',
            'nim'=>'required|numeric|unique:students,nim|min:0',
            'force'=>'required|numeric|min:0',
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
            'nim.unique'=>'NIM suda ada!',
            'nim.min'=>'NIM tidak boleh Negatif!',
            'force.required'=>'Tahun masuk harus diisi',
            'force.numeric'=>'Tahun masuk harus berupa angka',
            'force.min'=>'Tahun masuk tidak boleh Negatif!',
            'study_program_id.required'=>'Program Studi harus diisi',
            'student_types_id.required'=>'Jenis Beasiswa harus diisi',
        ];
    }
}
