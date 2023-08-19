<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetRequest extends FormRequest
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
            'file' => 'required|mimes:xls,xlsx'
        ];
    }
    public function messages()
    {
        return [
            'file.required' => 'هذا الحقل مطلوب',
            'file.mimes' => 'الرجاء ادخال ملف من نوع إكسل',


        ];
    }
}
