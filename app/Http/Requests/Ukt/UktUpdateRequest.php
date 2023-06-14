<?php

namespace App\Http\Requests\Ukt;

use Illuminate\Foundation\Http\FormRequest;

class UktUpdateRequest extends FormRequest
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
            'semester'=>'required|numeric',
            'type'=>'required',
            'amount'=>'required',
            // 'status'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'semester.required'=>'Semester harus diisi',
            'semester.numeric'=>'Semester harus berupa angka',
            'type.required'=>'Status harus diisi',
            'amount.required'=>'Jumlah harus diisi',
            // 'status.required'=>'Status harus diisi',
        ];
    }
}
