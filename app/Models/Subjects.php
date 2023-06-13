<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Subjects extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'Subjects';
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
