<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Payment extends Model
{
    use HasFactory,Auditable;
    Protected $table = 'payments';
    protected $fillable = ['user_id','session_master_id','order_id','bank_transaction_no','amount'];
}

