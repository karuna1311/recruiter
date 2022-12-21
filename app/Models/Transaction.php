<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Transaction extends Model
{
    use HasFactory,Auditable;
    Protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'cname',
        'order_id',
        'payment_id',
        'bank_transaction_no',
        'amount',
        'order_status',
        'trans_date',
        'response'
    ];
}

