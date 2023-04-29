<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientUpdateRequest extends PatientRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            ...@parent::rules(),
            'national_code' => 'exists:patients',
        ];
    }
}
