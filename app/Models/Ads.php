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
        'id',
        'title'

    ];
    protected $hidden = [
        'created_at',
        'updated_at	',
    ];
    public function section_ads()
    {
        return $this->hasMany(Section_ads::class, 'ad_id');
    }



    public function sections_ads(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Sections::class,
            "section_ads",
            "ad_id",
            "sections_id",
            "id",
            "id",
        );
    }
}
