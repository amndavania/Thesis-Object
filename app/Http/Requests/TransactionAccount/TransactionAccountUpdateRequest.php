<?php

namespace App\Http\Requests\TransactionAccount;

use Illuminate\Foundation\Http\FormRequest;

class TransactionAccountUpdateRequest extends FormRequest
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
            'id'=>'required|numeric|min:1|unique:transaction_accounts,id,'.$this->id,
            'name'=>'required|unique:transaction_accounts,name,'.$this->id,
            'lajurSaldo'=>'required',
            'lajurLaporan'=>'required',
            'accounting_group_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required'=>'Id Akun harus diisi',
            'id.unique'=>'Id Akun sudah ada',
            'id.numeric'=>'Id Akun harus berupa angka',
            'id.min'=>'Id harus bernilai > 0',
            'name.required'=>'Nama Akun harus diisi',
            'name.unique'=>'Nama Akun sudah ada',
            'lajurSaldo'=>'Lajur Saldo harus diisi',
            'lajurLaporan'=>'Lajur Laporan harus diisi',
            'accounting_group_id.required'=>'Grup Akun Transaksi harus diisi',
        ];
    }
}
