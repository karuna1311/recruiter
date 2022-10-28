<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminJobGroupPayment extends Model
{
    use HasFactory;
    
    Protected $table = 'job_group_payment';

    protected $connection = 'mysql2';

}
