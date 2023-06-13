<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study_program extends Model
{
    use HasFactory;
    protected $table = 'study_programs';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'session',
        'day',
        'section_id',
        'subject_id',
        'employee_id',
];
    protected $hidden = [
    'created_at',
    'updated_at  ',
];

public function subject()
{
    return $this->belongsTo(\App\Models\Subjects::class);
}
public function section()
{
    return $this->belongsTo(\App\Models\Sections::class);
}
public function employee()
{
    return $this->belongsTo(\App\Models\Employee::class);
}
}
