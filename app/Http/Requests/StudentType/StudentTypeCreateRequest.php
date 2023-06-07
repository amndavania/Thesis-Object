<?php

namespace App\Http\Requests\StudentType;

use Illuminate\Foundation\Http\FormRequest;

class StudentTypeCreateRequest extends FormRequest
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
            'type'=>'required|unique:student_types,type',
        ];
    }

    public function messages()
    {
        return [
            'type.required'=>'Nama beasiswa harus diisi',
            'type.unique'=>'Nama beasiswa sudah ada',
        ];
    }
}
