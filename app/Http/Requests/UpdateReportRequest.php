<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
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
          'prescription_id'=>'exists:prescriptions,id|nullable',
        ];
    }
    public function messages(): array
    {
        return [
            'prescription_id.exists' => 'نسخه وجود ندارد . لطفا به درستی انتخاب کنید',
        ];
    }
}
