<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section_ads extends Model
{
    use HasFactory;
    protected $table = 'section_ads';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'sections_id',
        'ad_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at	',
    ];
}
