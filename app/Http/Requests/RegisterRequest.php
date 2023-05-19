<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'نام را وارد کنید',
            'email.required' => 'ایمیل را وارد کنید',
            'email.email' => 'ایمیل را به درستی وارد کنید',
            'password.required' => 'رمزعبور را وارد کنید',
        ];
    }
}
