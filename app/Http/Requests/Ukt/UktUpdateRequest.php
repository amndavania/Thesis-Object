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
            'reference_number'=>'nullable|numeric|min:0',
            'amount'=>'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'semester.required'=>'Semester harus diisi',
            'semester.numeric'=>'Semester harus berupa angka',
            'reference_number'=>'Nomor referensi harus berupa angka',
            'reference_number'=>'Nomor referensi tidak boleh Negatif!',
            'amount.required'=>'Jumlah harus diisi',
            'amount.min'=>'Jumlah tidak boleh Negatif!',
        ];
    }
}
