<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $table = "employees";

    public $primaryKey = 'id';


    protected $fillable = [
        'id',
        'name',
        'fatherName',
        'motherName',
        'gender',
        'placeOfBirth',
        'birthDate',
        'nationality',
        'idNumber',
        'familyStatus',
        'husbandName',
        'husbandWork',
        'childrenNumber',
        'address',
        'landPhone',
        'mobilePhone',
        'certificate',
        'language',
        'jurisdiction',
        'computerSkills',
        'otherSkills',
        'socialInsurance',
        'lastSalaryReceived',
        'expectedSalary',
        'interview',
        'workYouWish',
        'managementNotes',
        'status',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'employee_id');
    }


    public $timestamps = true;

    protected $hidden = [
        'updated_at'

    ];

    public function study_program()
    {
        return $this->hasMany(Study_program::class, 'employee_id');
    }


    public $timestamps = true;

    protected $hidden = [
        'updated_at',


    ];
}
