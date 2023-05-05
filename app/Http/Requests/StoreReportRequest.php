<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
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
            'patient_id'=>'exists:patients,national_code',
//          'prescription_id'=>'',
            'title'=>'required|max:128',
            'content'=>'required|max:512',
        ];
    }
    public function messages(): array
    {
        return [
            'patient_id.exists' => 'بیمار وجود ندارد . لطفا به درستی انتخاب کنید',
            'title.required' => 'عنوان را وارد کنید',
            'title.max' => 'عنوان نامعتبر می باشد . لطفا حداکثر در ۱۲۸ کارکتر توضیح دهید',
            'content.required' => 'محتوا آزمایش یا گزارش را به درستی انتخاب کنید',
            'content.max' => 'محتوا آزمایش یا گزارش نامعتبر می باشد',
        ];
    }
}
