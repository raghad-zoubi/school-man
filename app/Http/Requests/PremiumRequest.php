<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PremiumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment' => ['required', 'numeric','min:100000'],
            'date'=> ['required' ,'date'],
        ];
    }
    public function messages()
    {
        return [
            'payment.required' => 'هذا الحقل مطلوب',
            'payment.min' => 'القيمة المدخلة يجب أن تكون 100000 على الأقل',
            'payment.numeric' => 'هذا الحقل يجب أن يحتوي على أرقام فقط',
            'date.required' => 'هذا الحقل مطلوب',
        ];
    }


}
