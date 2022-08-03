<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQualification extends Model
{
    use HasFactory;

    protected $table='user_qualification';

    protected $fillable = [
        'qualificationtype',
        'user_id',
        'qualificationname',
        'subject',
        'state',
        'university',
        'typeResult',
        'doq',
        'attempts',
        'percentage',
        'courseDurations',
        'classGrade',
        'mode',
        'compulsorySubjects',
        'optionalSubjects'
    ];
}
