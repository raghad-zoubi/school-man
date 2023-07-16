<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'fatherName' => ['required', 'string'],
            'motherName' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'placeOfBirth' => ['required', 'string'],
            'birthDate' => ['required', 'date'],
            'nationality' => ['required', 'string'],
            'idNumber' => ['required', 'integer'],
            'familyStatus' => ['required', 'string'],
            'husbandName' => ['string'],
            'husbandWork' => ['string'],
            'childrenNumber' => ['integer'],
            'address' => ['required', 'string'],
            'landPhone' => ['integer'],
            'mobilePhone' => ['integer'],
            'certificate' => ['required', 'string'],
            'jurisdiction' => ['required', 'string'],
            'language' => ['required', 'string'],
            'computerSkills' => ['string'],
            'otherSkills' => ['string'],
            'socialInsurance' => ['required', 'boolean'],
            'lastSalaryReceived' => ['integer'],
            'expectedSalary' => ['required', 'integer'],
            'interview' => ['required', 'date_format:Y-m-d H:i:s'],
            'workYouWish' => ['string'],
            'managementNotes' => ['string'],
        ];

    }
}
