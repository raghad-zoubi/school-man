<?php

namespace App\Models;
use App\Models\Students;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{

    use HasFactory;

   protected $table = 'reports';
  protected $primaryKey = 'id';
  public $timestamps = true;
    protected $fillable = [
        'id',
        'text',
        'students_id',


    ];
    protected $hidden = [
        'created_at',
        'updated_at	',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class);
    }




}
