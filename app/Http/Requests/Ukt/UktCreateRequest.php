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
            'semester'=>'required|numeric',
            'type'=>'required',
            'amount'=>'required',
            // 'status'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'students_id.required'=>'Mahasiswa harus diisi',
            'semester.required'=>'Semester harus diisi',
            'semester.numeric'=>'Semester harus berupa angka',
            'type.required'=>'Status harus diisi',
            'amount.required'=>'Jumlah harus diisi',
            // 'status.required'=>'Status harus diisi',
        ];
    }
}
