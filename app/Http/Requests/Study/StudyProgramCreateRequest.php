<?php

namespace App\Http\Requests\Study;

use Illuminate\Foundation\Http\FormRequest;

class StudyProgramCreateRequest extends FormRequest
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
            'name'=>'required|unique:study_programs,name',
            'faculty_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Nama Program Studi harus diisi',
            'name.unique'=>'Nama Program Studi sudah ada',
            'faculty_id.required'=>'Fakultas harus diisi',
        ];
    }
}
