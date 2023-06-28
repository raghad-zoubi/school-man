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
   public function study_program()
    {
        return $this->hasMany(Study_program::class, 'section_id');
    }

    public function classStudent()
    {
        return $this->belongsTo(Class_students::class);
    }

    public function sections_ads(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Ads::class,
            "section_ads",
            "sections_id",
            "ad_id",
            "id",
            "id",
        );
    }
}
