<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lookup extends Model
{
    use HasFactory;

    public $table = 'lookup_options';
}
