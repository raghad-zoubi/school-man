<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Illness extends Model
{
    use  HasFactory;

    protected $table = 'illnesses';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nameIllness',
        ' pharmaceutical',
        'student_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at	',
    ];
    public function section()
    {
        return $this->belongsTo(Sections::class, 'section_id');
    }
}
