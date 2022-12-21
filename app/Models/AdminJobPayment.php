<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminJobPayment extends Model
{
    use HasFactory,SoftDeletes;
    
    Protected $table = 'job_payment';

    protected $connection = 'mysql2';

}
