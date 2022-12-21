<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Payment extends Model
{
    use HasFactory,Auditable;
    Protected $table = 'payment_info';
    protected $fillable = ['user_id','transaction_info_id','payment_id','order_id','bank_ref_no','amount','tracking_id','order_status','payment_response_json'];
}

