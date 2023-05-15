<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialTransactionRequest extends FormRequest
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
            'title'=>'required|max:256',
            'method'=>'required|max:128',
            'payment_amount'=>'required|numeric',
            'comment'=>'nullable',
            'pay_time'=>'required|numeric',
            'changeable'=>'nullable',
        ];
    }
    public function messages(): array
    {
        return [
            'patient_id.required' => 'بیمار را انتخاب کنید',
            'patient_id.exists' => 'بیمار را به درستی انتخاب کنید',
            'patient_id.integer' => 'کد بیمار نامعتبر می باشد',
            'title.required' => 'عنوان پرداخت را وارد کنید',
            'title.max' => 'عنوان پرداخت از حد مجاز طولانی تر می باشد',
            'method.required' => 'نوع پرداخت را انتخاب کنید',
            'method.max' => 'نوع پرداخت نامعتبر می باشد',
            'payment_amount.required' => 'مبلغ پرداخت را وارد کنید',
            'payment_amount.numeric' => 'مبلغ پرداخت نامعتبر می باشد',
            'pay_time.required' => 'زمان پرداخت را انتخاب کنید',
            'pay_time.numeric' => 'زمان پرداخت باید تایم استمپ باشد (نامعتبر)',
        ];
    }
}
