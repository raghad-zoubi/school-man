<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Working_papers extends Model
{
    use HasFactory;
    protected $table = 'working_papers';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
    'text',
    'subject_id',
    'working_papers_type_id',
];
    protected $hidden = [
    'created_at',
    'updated_at  ',
];

    public function working_papers_type()
{
    return $this->belongsTo(\App\Models\Working_papers_type::class);
}
public function subject()
{
    return $this->belongsTo(\App\Models\Subjects::class);
}
}
