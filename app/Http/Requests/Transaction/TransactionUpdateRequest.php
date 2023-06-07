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
            'amount'=>'required',
            'transaction_accounts_id'=>'required',
        ];
    }

    public function messages()
    {
        return[
            'amount.required'=>'Jumlah harus diisi',
            'transaction_accounts_id.required'=>'Akun Transaksi harus diisi'
        ];
    }
}
