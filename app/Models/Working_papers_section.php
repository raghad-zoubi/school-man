<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Working_papers_section extends Model
{
    use HasFactory;
    protected $table = 'working_papers_sections';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'section_id',
        'working_papers_id',
];
    protected $hidden = [
    'created_at',
    'updated_at  ',
];

public function working_papers()
{
    return $this->belongsTo(\App\Models\Working_papers::class);
}
public function section()
{
    return $this->belongsTo(\App\Models\Sections::class);
}
}
