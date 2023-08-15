<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow_up_type extends Model
{



    use HasFactory;
    protected $table = 'follow_up_types';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at  ',
    ];


     public function  mark()
     {
         return $this->hasMany(Marks::class, 'follow_up_type_id');
     }

}
