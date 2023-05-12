<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class ImageRequest extends FormRequest
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
            'images.*' => 'required|image|max:2000',
        ];
    }
    public function messages(): array
    {
        return [
            'images.*' => 'تصاویر را به درستی انتخاب کنید . حجم فایل انتخابی باید کمتر از 2مگابایت و از انواع تصاویر با پسوند مجاز',
            'images.*.required' => 'تصویر را انتخاب کنید',
            'images.*.image' => 'تصاویر را به درستی انتخاب کنید . نوع فایل مجاز نمی باشد',
            'images.*.max' => 'اندازه تصاویر بزرگ می باشد ',
        ];
    }
//    protected $redirect = ;
//    protected $redirectRoute = 'insurances';

}
