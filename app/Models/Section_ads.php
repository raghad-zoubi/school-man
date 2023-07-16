<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section_ads extends Model
{
<<<<<<< HEAD
    use HasFactory;
=======

use HasFactory;
>>>>>>> 42231069c138dd2b54d030622428f18629ccb4f5
    protected $table = 'section_ads';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
<<<<<<< HEAD
        'sections_id',
        'ad_id',
    ];

=======
        'id',
        'sections_id',
        'ad_id',
    ];
>>>>>>> 42231069c138dd2b54d030622428f18629ccb4f5
    protected $hidden = [
        'created_at',
        'updated_at	',
    ];
<<<<<<< HEAD
=======



    public function ads(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Ads::class,"ad_id","id")->withDefault();
    }
    public function section(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sections::class,"sections_id","id")->withDefault();
    }

>>>>>>> 42231069c138dd2b54d030622428f18629ccb4f5
}
