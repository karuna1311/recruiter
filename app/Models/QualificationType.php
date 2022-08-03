<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualificationType extends Model
{
    use HasFactory;

    public $table = 'qualificationtype';

    protected $fillable = [
        'qualification_type_code ',
        'qualification_type_name',
        'sort_order',
        'translations'

    ];

}
