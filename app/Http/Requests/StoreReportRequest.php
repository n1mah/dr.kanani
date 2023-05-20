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
            'title'=>'required|max:128',
            'content'=>'nullable|max:512',
            'images.*' => 'required|image|max:2000',
        ];
    }
    public function messages(): array
    {
        return [
            'patient_id.exists' => 'بیمار وجود ندارد . لطفا به درستی انتخاب کنید',
            'title.required' => 'عنوان را وارد کنید',
            'title.max' => 'عنوان نامعتبر می باشد . لطفا حداکثر در ۱۲۸ کارکتر توضیح دهید',
            'content.max' => 'محتوا آزمایش یا گزارش نامعتبر می باشد',
            'images.*' => 'تصاویر را به درستی انتخاب کنید . حجم فایل انتخابی باید کمتر از 2مگابایت و از انواع تصاویر با پسوند مجاز',
            'images.*.required' => 'تصویر را انتخاب کنید',
            'images.*.image' => 'تصاویر را به درستی انتخاب کنید . نوع فایل مجاز نمی باشد',
            'images.*.max' => 'اندازه تصاویر بزرگ می باشد ',
        ];
    }
}
