<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class AccountingGroupUpdateRequest extends FormRequest
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
        $accounting_group_id = $this->route('accounting_group');

        return [
            'name'=>'required|unique:accounting_groups,name,'.$accounting_group_id,
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Nama Grup harus diisi',
            'name.unique'=>'Nama Grup sudah ada',
        ];
    }
}
