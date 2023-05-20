<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrescriptionRequest extends FormRequest
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
            'reason'=>'required|max:255',
            'text_prescription'=>'nullable',
        ];
    }
    public function messages(): array
    {
        return [
            'reason.required' => 'دلیل مراجعه را وارد کنید',
            'reason.max' => 'دلیل مراجعه نامعتبر می باشد . لطفا حداکثر در ۲۵۵ کارکتر توضیح دهید',
        ];
    }
}
