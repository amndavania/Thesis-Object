<?php

namespace App\Http\Requests\StudentType;

use Illuminate\Foundation\Http\FormRequest;

class StudentTypeUpdateRequest extends FormRequest
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
        // $student_type_id = $this->route('student_type');

        return [
            'type'=>'required|unique:student_types,type,'.$this->type,
            'year'=>'required|numeric|min:0',
            'study_program_id'=>'required',
            'dpp'=>'numeric|min:0',
            'krs'=>'numeric|min:0',
            'uts'=>'numeric|min:0',
            'uas'=>'numeric|min:0',
            'wisuda'=>'nullable|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'type.required'=>'Nama program harus diisi',
            'type.unique'=>'Nama program sudah ada',
            'year.required'=>'Tahun harus diisi',
            'year.min'=>'Tahun tidak boleh Negatif!',
            'study_program_id'=>'Program Studi harus diisi',
            'dpp.numeric'=>'DPP harus berupa angka',
            'dpp.min'=>'DPP tidak boleh Negatif!',
            'krs.numeric'=>'KRS harus berupa angka',
            'krs.min'=>'KRS tidak boleh Negatif!',
            'uts.numeric'=>'UTS harus berupa angka',
            'uts.min'=>'UTS tidak boleh Negatif!',
            'uas.numeric'=>'UAS harus berupa angka',
            'uas.min'=>'UAS tidak boleh Negatif!',
            'wisuda.numeric'=>'Nominal WISUDA harus berupa angka',
            'wisuda.min'=>'Nominal WISUDA tidak boleh Negatif!',
        ];
    }
}
