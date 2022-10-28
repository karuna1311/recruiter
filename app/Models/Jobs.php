<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
    
    Protected $table = 'job_adv';

    protected $connection = 'mysql2';

    protected $fillable = [
        'name',
        'name_dvng',
        'year',
        'description'
    ];

}
