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
            'description' => 'nullable',
            'images.*' => 'required|image|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'images.0.required' => 'تصویر را انتخاب کنید',
            'images.0.image' => 'تصویر را به درستی انتخاب کنید',
            'images.0.max' => 'اندازه تصویر بزرگ می باشد ',
        ];
    }
//    protected $redirect = ;
//    protected $redirectRoute = 'insurances';

}
