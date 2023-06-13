<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{

    use HasFactory;
    protected $table = 'notes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
    'typeNote',
    'semester',
    'date',
    'text',
    'student_id',
    'subject_id',

];
    protected $hidden = [
    'created_at',
    'updated_at  ',
];

    public function student()
{
    return $this->belongsTo(\App\Models\Students::class);
}

public function subject()
{
    return $this->belongsTo(\App\Models\subjects::class);
}
}
