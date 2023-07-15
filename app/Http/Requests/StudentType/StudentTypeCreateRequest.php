<?php

namespace App\Http\Requests\StudentType;

use Illuminate\Foundation\Http\FormRequest;

class StudentTypeCreateRequest extends FormRequest
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
            'type'=>'required|unique:student_types,type',
            'year'=>'required|numeric|min:0',
            'study_program_id'=>'required',
            'dpp'=>'nullable|numeric|min:0',
            'krs'=>'nullable|numeric|min:0',
            'uts'=>'nullable|numeric|min:0',
            'uas'=>'nullable|numeric|min:0',
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
            'dpp.numeric'=>'Nominal DPP harus berupa angka',
            'dpp.min'=>'Nominal DPP tidak boleh Negatif!',
            'krs.numeric'=>'Nominal KRS harus berupa angka',
            'krs.min'=>'Nominal KRS tidak boleh Negatif!',
            'uts.numeric'=>'Nominal UTS harus berupa angka',
            'uts.min'=>'Nominal UTS tidak boleh Negatif!',
            'uas.numeric'=>'Nominal UAS harus berupa angka',
            'uas.min'=>'Nominal UAS tidak boleh Negatif!',
            'wisuda.numeric'=>'Nominal WISUDA harus berupa angka',
            'wisuda.min'=>'Nominal WISUDA tidak boleh Negatif!',

        ];
    }
}
