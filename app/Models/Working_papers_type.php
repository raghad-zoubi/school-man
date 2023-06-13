<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Working_papers_type extends Model
{
    use HasFactory;
    protected $table = 'working_papers_types';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
    'name',
];
    protected $hidden = [
    'created_at',
    'updated_at  ',
];
}
