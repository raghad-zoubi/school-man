<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


namespace App\Http\Requests;

class StudentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required','regex:/^[أ-يa-zA-Z\s]+$/u',
            'nickname' => 'required','regex:/^[أ-يa-zA-Z\s]+$/u',
            'fatherName' => 'required','regex:/^[أ-يa-zA-Z\s]+$/u',
            'workFather'=> 'required','regex:/^[أ-يa-zA-Z\s]+$/u',
            'motherName' => 'required','regex:/^[أ-يa-zA-Z\s]+$/u',
            'workMother' => 'required','regex:/^[أ-يa-zA-Z\s]+$/u',
            'gender' => 'required','string',
            'newClass' => 'required','string',
            'schoolTransferred' => 'nullable','string',
            'average' =>'nullable',
            'placeOfBirth' => 'required','string',
            'birthDate'=> 'required', 'date',
            'brothersNumber'=> 'required', 'integer',
            'address'=> 'required', 'string',
            'matherPhone'=>'regex:/^09\d{8}$/','nullable',
            'fatherPhone'=>'regex:/^09\d{8}$/','nullable',
            'livesStudent'=>'required', 'string',
            'landPhone'=>'integer','digits:7','nullable',
            'character'=>'required', 'string',
            'transportationType'=>'required', 'string',
            'result','nullable',
            'percentage','nullable',
            'managementNotes','nullable',
//            =>'string',
            'date'=> 'required', 'date',
            'grandFather'=>'required','regex:/^[أ-يa-zA-Z\s]+$/u',
            'total'=>'required','numeric'


        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'هذا الحقل مطلوب',
            'name.regex' => 'الاسم يجب أن لايحتوي على أرقام',

            'nickname.required' => 'هذا الحقل مطلوب',
            'nickname.regex' => 'الشهرة يجب أن لاتحتوي على أرقام',

            'fatherName.required' => 'هذا الحقل مطلوب',
            'fatherName.regex' => 'اسم الأب يجب أن لايحتوي على أرقام',

            'workMother.required' => 'هذا الحقل مطلوب',
            'workMother.regex' => 'عمل الام يجب أن لايحتوي على أرقام',

            'motherName.required' => 'هذا الحقل مطلوب',
            'motherName.regex' => 'اسم الأم يجب أن لايحتوي على أرقام',

            'workFather.required' => 'هذا الحقل مطلوب',
            'workFather.regex' => 'عمل الاب يجب أن لايحتوي على أرقام',

            'gender.required' => 'هذا الحقل مطلوب',

            'newClass.required' => 'هذا الحقل مطلوب',

            'schoolTransferred.required' => 'هذا الحقل مطلوب',

            'placeOfBirth.required' => 'هذا الحقل مطلوب',

            'birthDate.required' => 'هذا الحقل مطلوب',

            'brothersNumber.required' => 'هذا الحقل مطلوب',
            'brothersNumber.regex' => 'عدد الأخوة يجب أن يكون رقم',

            'total.numeric' => 'المبلغ يجب أن يكون رقم',
            'total.required' => 'هذا الحقل مطلوب',

            'address.required' => 'هذا الحقل مطلوب',

            'matherPhone.regex' => 'رقم الجوال يجب أن يكون 10 أرقام ويبدأ ب 09 ',

            'fatherPhone.regex' => 'رقم الجوال يجب أن يكون 10 أرقام ويبدأ ب 09 ',

            'livesStudent.required' => 'هذا الحقل مطلوب',

            'landPhone.integer' => 'هذا الحقل يجب أن يحتوي على أرقام فقط',
            'landPhone.digits' => 'الرقم الأرضي يجب أن يكون 7 أرقام ',

            'character.required' => 'هذا الحقل مطلوب',

            'transportationType.required' => 'هذا الحقل مطلوب',

            'date.required' => 'هذا الحقل مطلوب',

            'grandFather.required' => 'هذا الحقل مطلوب',
            'grandFather.regex' => 'اسم الجد يجب أن لايحتوي على أرقام',


//            'idNumber.required' => 'هذا الحقل مطلوب',
//            'idNumber.regex' => 'الرقم الوطني يجب أن يكون 11 رقم',
//            'idNumber.numeric' => 'هذا الحقل يجب أن يحتوي على أرقام فقط',
//            'idNumber.unique' => 'هذا الرقم موجود من قبل',
//
//            'familyStatus.required' => 'هذا الحقل مطلوب',
//
//            'husbandName.regex' => 'هذا الحقل يجب أن لا يحتوي على أرقام',
//
//            'husbandWork.regex' => 'هذا الحقل يجب أن لا يحتوي على أرقام',
//
//            'childrenNumber.numeric' => 'هذا الحقل يجب أن يحتوي على أرقام فقط',
//
//
//
//            'landPhone.unique' => 'هذا الرقم موجود من قبل',
//
//            'mobilePhone.required' => 'هذا الحقل مطلوب',
//
//            'mobilePhone.unique' => 'هذا الرقم موجود من قبل',
//
//            'certificate.required' => 'هذا الحقل مطلوب',
//
//            'jurisdiction.required' => 'هذا الحقل مطلوب',
//
//            'language.required' => 'هذا الحقل مطلوب',
//
//            'socialInsurance.required' => 'هذا الحقل مطلوب',
//            'lastSalaryReceived.integer' => 'هذا الحقل يجب أن يحتوي على أرقام فقط',
//
//            'expectedSalary.required' => 'هذا الحقل مطلوب',
//            'expectedSalary.integer' => 'هذا الحقل يجب أن يحتوي على أرقام فقط',
//
//            'interview.required' => 'هذا الحقل مطلوب',
//
//            'workYouWish.required' => 'هذا الحقل مطلوب',



        ];
    }
}
