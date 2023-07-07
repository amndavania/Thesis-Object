<?php

namespace App\Http\Requests\Ukt;

use Illuminate\Foundation\Http\FormRequest;

class UktCreateRequest extends FormRequest
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
            'students_id'=>'required',
            'year'=>'required',
            'semester'=>'required',
            'type'=>'required',
            'amount'=>'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'students_id.required'=>'Mahasiswa harus diisi',
            'year.required'=>'Tahun Ajaran harus diisi',
            'semester.required'=>'Semester harus diisi',
            'type.required'=>'Status harus diisi',
            'amount.required'=>'Jumlah harus diisi',
            'amount.min'=>'Jumlah tidak boleh Negatif!'
        ];
    }
}
