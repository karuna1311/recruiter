<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EligibleCandidates extends Model
{
    use HasFactory;

    Protected $table = 'eligible_candidates';

    protected $fillable = [
        'user_id',
        'job_id',
        'status'
    ];
}
