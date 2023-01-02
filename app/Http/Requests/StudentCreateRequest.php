<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nis' => 'required|unique:students|min:9|max:10',
            'name' => 'required|max:50',
            'gender' => 'required',
            'class_id' => 'required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'class_id' => 'class',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nis.required' => 'NIS wajib diisi.',
            'nis.max' => 'NIS tidak boleh lebih dari :max.',
            'name.required' => 'Nama wajib diisi.',
            'class_id.required' => 'Kelas wajib diisi.',
            'gender.required' => 'Gender wajib diisi.',
        ];
    }
}
