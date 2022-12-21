<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppliedJobByUser extends Model
{
    use HasFactory;

    Protected $table = 'applied_job_by_user';

    protected $fillable = [
        'user_id',
        'job_id',
        'eligible_cand_id',
        'json',
        'application_no',
        'payment_status',
        'bank_ref_no'
    ];
}
