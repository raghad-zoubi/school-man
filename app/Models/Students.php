<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Students extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'students';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'fatherName',
        'workFather',
        'motherName',
        'workMother',
        'gender',
        'newClass',
        'schoolTransferred',
        'average',
        'placeOfBirth',
        'birthDate',
        'brothersNumber',
        'address',
        'matherPhone',
        'fatherPhone',
        'livesStudent',
        'landPhone',
        'character',
        'transportationType',
        'result',
        'percentage',
        'managementNotes',
        'password',
    ];
    protected $hidden = [
        'created_at',
        'updated_at	',
    ];
    public function Student_times()
    {
        return $this->hasMany(Student_time::class, 'student_id');
    }
    public function Section_students()
    {
        return $this->hasMany(Section_student::class, 'student_id');
    }
}
