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
            'national_code' => 'required|unique:patients|integer|digits:10',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'day' => 'required|max:2|min:1',
            'month' => 'required|max:2|min:1',
            'year' => 'required|digits:4',
            'insurance_id' => 'required|exists:insurances,id|integer',
            'mobile' => 'required|digits:11',
            'phone' => 'nullable|digits:11',
        ];
    }
    public function messages(): array
    {
        return [
            'national_code.required' => 'کدملی را وارد کنید',
            'national_code.unique' => 'این کد ملی قبلا ثبت شده است',
            'national_code.integer' => 'کدملی باید عدد ۱۰ رقمی باشد',
            'national_code.digits' => 'کدملی باید عدد ۱۰ رقمی باشد',
            'firstname.required' => 'نام بیمار را وارد کنید',
            'firstname.max' => 'نام بیمار مجاز نمی باشد (حداکثر ۲۵۵ کارکتر)',
            'lastname.required' => 'نام خانوادگی بیمار را وارد کنید',
            'lastname.max' => 'نام خانوادگی بیمار مجاز نمی باشد (حداکثر ۲۵۵ کارکتر)',
            'day.required' => 'روز را وارد کنید',
            'month.required' => 'ماه را وارد کنید',
            'year.required' => 'سال را وارد کنید',
            'day.max' => 'روز را به درستی وارد کنید',
            'day.min' => 'روز را به درستی وارد کنید',
            'month.max' => 'ماه را به درستی وارد کنید',
            'month.min' => 'ماه را به درستی وارد کنید',
            'year.digits' => 'سال را به درستی وارد کنید',
            'insurance_id.required' => 'نوع بیمه را وارد کنید',
            'insurance_id.exists' => 'بیمه انتخابی نا معتبر می باشد ( لطفا از لیست به درستی انتخاب کنید)',
            'insurance_id.integer' => 'بیمه انتخابی نا معتبر می باشد ( لطفا از لیست به درستی انتخاب کنید)',
            'mobile.required' => 'موبایل را وارد کنید',
            'mobile.digits' => ' موبایل را به درستی وارد کنید (۱۱رقم)',
            'phone.digits' => ' تلفن را به درستی وارد کنید (۱۱رقم)',
        ];
    }
}
