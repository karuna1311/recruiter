<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminJobPayment extends Model
{
    use HasFactory;
    
    Protected $table = 'job_payment';

    protected $connection = 'mysql2';

}
