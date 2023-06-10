<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_students extends Model
{
    use HasFactory;
    protected $table = 'class_students';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name',
    ];
    protected $hidden = [
        'created_at',
        'updated_at ',
    ];
    public function sections()
    {
        return $this->hasMany(Sections::class,'class_student_id');
    }
}
