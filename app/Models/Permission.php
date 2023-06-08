<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{


    use HasFactory;
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
    'person',
    'student_id',
    'semester',
    'date',

];
    protected $hidden = [
    'created_at',
    'updated_at  ',
];

    public function student()
{
    return $this->belongsTo(\App\Models\Students::class);
}
}
