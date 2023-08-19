<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^[أ-يa-zA-Z\s]+$/u'],
            'fatherName' => ['required', 'regex:/^[أ-يa-zA-Z\s]+$/u'],
            'motherName' => ['required', 'regex:/^[أ-يa-zA-Z\s]+$/u'],
            'gender' => ['required', 'regex:/^[أ-يa-zA-Z\s]+$/u'],
            'placeOfBirth' => ['required', 'string'],
            'birthDate' => ['required', 'date'],
            'nationality' => ['required', 'string'],
            'idNumber' => ['required', 'min:0', 'regex:/^[0-9]{11}$/', Rule::unique('employees'), 'numeric'],
            'familyStatus' => ['required', 'string'],
            'husbandName' => ['regex:/^[أ-يa-zA-Z\s]+$/u'],
            'husbandWork' => ['regex:/^[أ-يa-zA-Z\s]+$/u'],
            'childrenNumber' => ['numeric'],
            'address' => ['required', 'string'],
            'landPhone' => ['integer', 'digits:7', Rule::unique('employees')],
            'mobilePhone' => ['required', 'regex:/^09\d{8}$/', Rule::unique('employees')],
            'certificate' => ['required', 'string'],
            'jurisdiction' => ['required', 'string'],
            'language' => ['required', 'string'],
            'computerSkills' => [],
            'otherSkills' => [],
            'socialInsurance' => ['required', 'boolean'],
            'lastSalaryReceived' => ['integer'],
            'expectedSalary' => ['required', 'integer'],
            'interview' => ['required', 'date_format:Y-m-d\TH:i'],
            'workYouWish' => ['required'],
            'managementNotes' => [],

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'هذا الحقل مطلوب',
            'name.regex' => 'الاسم يجب أن لايحتوي على أرقام',

            'fatherName.required' => 'هذا الحقل مطلوب',
            'fatherName.regex' => 'اسم الأب يجب أن لايحتوي على أرقام',

            'motherName.required' => 'هذا الحقل مطلوب',
            'motherName.regex' => 'اسم الأم يجب أن لايحتوي على أرقام',

            'gender.required' => 'هذا الحقل مطلوب',
            'gender.regex' => 'الجنس يجب أن لا يحتوي على أرقام',

            'placeOfBirth.required' => 'هذا الحقل مطلوب',

            'birthDate.required' => 'هذا الحقل مطلوب',

            'nationality.required' => 'هذا الحقل مطلوب',

            'idNumber.required' => 'هذا الحقل مطلوب',
            'idNumber.regex' => 'الرقم الوطني يجب أن يكون 11 رقم',
            'idNumber.numeric' => 'هذا الحقل يجب أن يحتوي على أرقام فقط',
            'idNumber.unique' => 'هذا الرقم موجود من قبل',

            'familyStatus.required' => 'هذا الحقل مطلوب',

            'husbandName.regex' => 'هذا الحقل يجب أن لا يحتوي على أرقام',

            'husbandWork.regex' => 'هذا الحقل يجب أن لا يحتوي على أرقام',

            'childrenNumber.numeric' => 'هذا الحقل يجب أن يحتوي على أرقام فقط',

            'address.required' => 'هذا الحقل مطلوب',

            'landPhone.integer' => 'هذا الحقل يجب أن يحتوي على أرقام فقط',
            'landPhone.digits' => 'الرقم الأرضي يجب أن يكون 7 أرقام ',
            'landPhone.unique' => 'هذا الرقم موجود من قبل',

            'mobilePhone.required' => 'هذا الحقل مطلوب',
            'mobilePhone.regex' => 'رقم الجوال يجب أن يكون 10 أرقام ويبدأ ب 09 ',
            'mobilePhone.unique' => 'هذا الرقم موجود من قبل',

            'certificate.required' => 'هذا الحقل مطلوب',

            'jurisdiction.required' => 'هذا الحقل مطلوب',

            'language.required' => 'هذا الحقل مطلوب',

            'socialInsurance.required' => 'هذا الحقل مطلوب',

            'lastSalaryReceived.integer' => 'هذا الحقل يجب أن يحتوي على أرقام فقط',
            'expectedSalary.required' => 'هذا الحقل مطلوب',
            'expectedSalary.integer' => 'هذا الحقل يجب أن يحتوي على أرقام فقط',

            'interview.required' => 'هذا الحقل مطلوب',

            'workYouWish.required' => 'هذا الحقل مطلوب',



        ];
    }
}
