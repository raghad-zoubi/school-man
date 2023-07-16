<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;
    protected $table = 'ads';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'text',
        'type',
    ];

    public function section_ads()
    {
        return $this->hasMany(Section_ads::class, 'ad_id');
    }
}
