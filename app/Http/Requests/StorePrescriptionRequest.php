<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionRequest extends FormRequest
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
            'appointment_id'=>'exists:appointments,id|nullable',
            'reason'=>'required|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'appointment_id.exists' => 'وقت (نوبت) وجود ندارد . لطفا به درستی انتخاب کنید',
            'reason.required' => 'دلیل مراجعه را وارد کنید',
            'reason.max' => 'دلیل مراجعه نامعتبر می باشد . لطفا حداکثر در ۲۵۵ کارکتر توضیح دهید',
        ];
    }
}
