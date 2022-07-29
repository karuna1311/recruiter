<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleMaster extends Model
{
    use HasFactory;
    Protected $table = 'schedule_masters';
    public function sessionData()
    {
        return $this->hasOne(SessionMaster::class,'id','session');
    }
}
