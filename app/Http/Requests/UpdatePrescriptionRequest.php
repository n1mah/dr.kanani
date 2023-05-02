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
//            'appointment_id'=>'exists:appointments,id|nullable',
            'reason'=>'required|max:255',
            'type'=>'required|max:64',
            'text_prescription'=>'nullable',
        ];
    }
    public function messages(): array
    {
        return [
//            'appointment_id.integer' => 'وقت (نوبت) نامعتبر می باشد',
//            'appointment_id.exists' => 'وقت (نوبت) وجود ندارد . لطفا به درستی انتخاب کنید',
            'reason.required' => 'دلیل مراجعه را وارد کنید',
            'reason.max' => 'دلیل مراجعه نامعتبر می باشد . لطفا حداکثر در ۲۵۵ کارکتر توضیح دهید',
            'type.required' => 'نوع ویزیت را به درستی انتخاب کنید',
            'type.max' => 'نوع ویزیت نامعتبر می باشد',
        ];
    }
}
