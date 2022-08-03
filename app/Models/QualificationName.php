<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualificationName extends Model
{
    use HasFactory;

    public $table = 'qualificationname';
    
    protected $fillable = [
        'qualification_name_code',
        'qualification_type_code',
        'qualification_name',
        'sort_order',
        'translations'
    ];
}
