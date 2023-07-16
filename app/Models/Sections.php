<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    use HasFactory;
    protected $table = 'sections';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'gender',
        'capacity',
        'class_student_id',

    ];
    protected $hidden = [
        'created_at',
        'updated_at	',
    ];
    public function Section_students()
    {
        return $this->hasMany(Section_student::class, 'sections_id');
    }
    public function classStudent()
    {
        return $this->belongsTo(Class_students::class);
    }
    public function Section_ads()
    {
        return $this->hasMany(Section_ads::class, 'sections_id');
    }
    public function workpapers_Section()
    {
        return $this->hasMany(Working_papers_section::class, 'section_id');
    }
}
