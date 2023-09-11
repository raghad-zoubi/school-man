<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name',

    ];
    protected $hidden = [
        'created_at',
        'updated_at	',
    ];
    public function study_program()
    {
        return $this->hasMany(Study_program::class, 'subject_id');
    }
}

