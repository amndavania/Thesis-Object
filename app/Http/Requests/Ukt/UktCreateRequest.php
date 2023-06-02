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
            'reference_number'=>'nullable',
            'amount'=>'required|numeric',
            'total'=>'required|numeric',
            'status'=>'required',
            'transaction_accounts_id'=>'required',          
        ];
    }

    public function messages()
    {
        return [
            'students_id.required'=>'Mahasiswa wajib diisi',
            'semester.required'=>'Semester wajib diisi',
            'amount.required'=>'Jumlah wajib diisi',
            'total.required'=>'Total wajib diisi',
            'status.required'=>'Status wajib diisi',
            'transaction_accounts_id.required'=>'Akun Transaksi wajib diisi',
        ];
    }
}
