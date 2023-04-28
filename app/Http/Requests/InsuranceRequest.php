<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class InsuranceRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */

        public function rules(): array
    {
        return [
            'title'=>'required',
            'fee'=>'required|numeric',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'عنوان بیمه را وارد کنید',
            'fee.required' => 'مبلغ ویزیت این بیمه را وارد کنید',
            'fee.numeric' => 'مبلغ ویزیت را به درستی وارد کنید ( عدد انگلیسی )',
        ];
    }
//    protected $redirect = ;
//    protected $redirectRoute = 'insurances';

}
