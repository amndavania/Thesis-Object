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
            'dpp'=>'required|numeric',
            'krs'=>'required|numeric',
            'uts'=>'required|numeric',
            'uas'=>'required|numeric',
            'wisuda'=>'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'type.required'=>'Nama beasiswa wajib diisi',
            'type.unique'=>'Nama beasiswa sudah ada',
            'dpp.required'=>'Nominal DPP wajib diisi',
            'dpp.numeric'=>'Nominal DPP harus berupa angka',
            'krs.required'=>'Nominal KRS wajib diisi',
            'krs.numeric'=>'Nominal KRS harus berupa angka',
            'uts.required'=>'Biaya UTS wajib diisi',
            'uts.numeric'=>'Biaya UTS harus berupa angka',
            'uas.required'=>'Biaya UAS wajib diisi',
            'uas.numeric'=>'Biaya UAS harus berupa angka',
            'wisuda.required'=>'Biaya Wisuda wajib diisi',
            'wisuda.numeric'=>'Biaya Wisuda harus berupa angka',
        ];
    }
}
