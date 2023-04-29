<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'patient_id'=>'required|exists:patients,national_code|integer',
            'type'=>'required|max:64',
            'visit_time'=>'required|numeric',
            'descriptions'=>'nullable',
        ];
    }
    public function messages(): array
    {
        return [
            'patient_id.required' => 'بیمار را انتخاب کنید',
            'patient_id.exists' => 'بیمار را به درستی انتخاب کنید',
            'patient_id.integer' => 'کد بیمار نامعتبر می باشد',
            'type.required' => 'نوع ویزیت را وارد کنید',
            'type.max' => 'نوع ویزیت نامعتبر می باشد',
            'visit_time.required' => 'زمان ویزیت را انتخاب کنید',
            'visit_time.numeric' => 'زمان ویزیت باید تایم استمپ باشد (نامعتبر)',
        ];
    }
}
