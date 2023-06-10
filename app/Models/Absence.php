<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;
    protected $table = 'absences';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'reason',
        'student_id',
        'semester',
        'date',
        'typeAbsence',
    ];
    protected $hidden = [
        'created_at',
        'updated_at  ',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class);
    }

}
