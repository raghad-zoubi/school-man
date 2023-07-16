<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;


    use HasFactory;
    protected $table = 'marks';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'studentMark',
        'student_id',
        'semester',
        'lowMark',
        'highMark',
        'id',
        'follow_up_type_id',
        'subject_id',
        'date'
    ];
    protected $hidden = [
        'created_at',
        'updated_at  ',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class);
    }

  public function subject()
    {
        return $this->belongsTo(Subjects::class);
    }
 public function follow_up_type()
    {
        return $this->belongsTo(Follow_up_type::class);
    }


}
