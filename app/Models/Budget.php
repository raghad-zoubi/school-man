<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    /**
     * @var mixed
     */
    public $table = "budgets";

    public $primaryKey = 'id';


    protected $fillable = [
        'name',
        'email',
    ];
    protected $hidden = [
        'created_at',
        'updated_at ',
    ];
}
