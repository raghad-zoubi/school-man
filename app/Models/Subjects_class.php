<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects_class extends Model
{
    use HasFactory;
    protected $table = 'subjects_classes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'highMark',
        'highMark',
        'subject_id',
        'class_student_id',
];
    protected $hidden = [
    'created_at',
    'updated_at  ',
];

public function subject()
{
    return $this->belongsTo(\App\Models\Subjects::class);
}

public function class_student()
{
    return $this->belongsTo(\App\Models\Class_students::class);
}
}
