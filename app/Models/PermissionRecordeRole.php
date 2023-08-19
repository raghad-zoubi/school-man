<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRecordeRole extends Model
{
    use HasFactory;
    public $table = "permission_recorde_roles";

    public $primaryKey = 'id';


    protected $fillable = [
        'id',
        'check',
        'role_id',
        'permission_id',

    ];
}
