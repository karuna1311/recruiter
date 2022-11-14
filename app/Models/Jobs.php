<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jobs extends Model
{
    use HasFactory,SoftDeletes;
    
    Protected $table = 'job_adv';

    protected $connection = 'mysql2';

    protected $fillable = [
        'name',
        'name_dvng',
        'year',
        'description'
    ];

}
