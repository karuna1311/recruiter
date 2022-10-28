<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    use HasFactory;

    protected $table ='user_experience';

    protected $fillable = [
        'user_id',
        'employmentType',
        'flgMpscSelection',
        'postNameLookupId',
        'officeName',
        'flgOfficeGovOwned',
        'designation',
        'jobNatureLookupId',
        'flgGazettedPost',
        'typeGroup',
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
