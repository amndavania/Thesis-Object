<?php

namespace App\Http\Requests\Faculty;

use Illuminate\Foundation\Http\FormRequest;

class FacultyUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|unique:faculties,name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Nama Fakultas wajib diisi',
            'name.unique'=>'Nama Fakultas sudah ada',
        ];
    }
}
