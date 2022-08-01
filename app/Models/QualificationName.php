<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualificationName extends Model
{
    use HasFactory;

    public $table = 'qualificationname';
    
    protected $fillable = [
        'qualificationnamecode',
        'qualificationtypecode',
        'qualificationname',
        'sort_order',
        'translations'
    ];
}
