<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Transaction extends Model
{
    use HasFactory,Auditable;
    Protected $table = 'transactions';
    protected $fillable = ['master_pgd_id','session_master_id','user_id','order_id','bank_transaction_no','amount','order_status','trans_date','response'];
}

