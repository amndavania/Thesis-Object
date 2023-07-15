<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class TransactionUpdateRequest extends FormRequest
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
            'description'=>'required',
            'type'=>'required',
            'reference_number'=>'nullable|numeric|min:0',
            'amount'=>'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return[
            'description.required'=>'Deskripsi harus diisi',
            'type.required'=>'Tipe harus diisi',
            'reference_number'=>'Nomor referensi harus berupa angka',
            'reference_number'=>'Nomor referensi tidak boleh Negatif!',
            'amount.required'=>'Nominal harus diisi',
            'amount.min'=>'Nominal tidak boleh Negatif'
        ];
    }
}
