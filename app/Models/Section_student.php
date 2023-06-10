<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section_student extends Model
{
    use HasFactory;
    protected $table = 'section_students';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
       'semester',
        'sections_id',
        'student_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at	',
    ];
    public function student()
    {
        return $this->belongsTo(Students::class);
    }
    public function section()
    {
        return $this->belongsTo(Sections::class);
    }
}
