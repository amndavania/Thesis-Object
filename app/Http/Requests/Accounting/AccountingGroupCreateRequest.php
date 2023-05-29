<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class AccountingGroupCreateRequest extends FormRequest
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
            'id'=>'required|numeric|unique:accounting_groups,id',
            'name'=>'required|alpha|unique:accounting_groups,name',
            'description'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required'=>'Id Akun wajib diisi',
            'id.unique'=>'Id Akun sudah ada',
            'id.numeric'=>'Id Akun harus berupa angka',
            'name.required'=>'Nama Akun wajib diisi',
            'name.unique'=>'Nama Akun sudah ada',
            'name.alpha'=>'Nama Akun harus berupa huruf',
            'description.required'=>'Deskripsi wajib diisi',
        ];
    }
}
