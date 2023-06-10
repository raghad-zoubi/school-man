<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_time extends Model
{
    use HasFactory;
    protected $table = 'student_times';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'semester',
        'date',
        'student_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at	',
    ];
    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
    public function delays()
    {
        return $this->hasMany(Delay::class, 'student_time_id');
    }
    public function absences()
    {
        return $this->hasMany(Absence::class, 'student_time_id');
    }
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'student_time_id');
    }

}
