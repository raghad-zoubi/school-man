<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Delay extends Model
{


    use HasFactory;
    protected $table = 'delays';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'reason',
        'student_id',
        'duration',
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
