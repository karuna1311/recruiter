<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserExperience extends Model
{
    use HasFactory,SoftDeletes;

    protected $table ='user_experience';

    protected $fillable = [
        'user_id',
        'employmentType',     
        'postNameLookupId',
        'officeName',
        'designation',
        'jobNatureLookupId',      
        'apointmentNatureLookupId',
        'time',
        'appointmentLetterNo',
        'letterDate',
        'payScale',
        'gradePay',
        'basicPay',
        'monthlyGrossSalary',
        'fromDate',
        'toDate',
        'expYears',
        'expMonths',
        'expDays',
    ];

}
