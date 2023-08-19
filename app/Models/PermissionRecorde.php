<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRecorde extends Model
{
    use HasFactory;


    public $table = "permission_recordes";

    public $primaryKey = 'id';


    protected $fillable = [
        'id',
        'name',

    ];


    public $timestamps = true;

    protected $hidden = [
        'updated_at',
        'created_at'

    ];
}
