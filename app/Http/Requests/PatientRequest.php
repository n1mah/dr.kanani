<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'national_code' => 'required|unique:patients|integer|size:10',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'birthday' => 'required|date',
            'insurance_id' => 'required|integer',
            'mobile' => 'required|size:11',
        ];
    }
}
