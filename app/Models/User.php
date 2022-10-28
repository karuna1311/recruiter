<?php

namespace App\Models;

use App\Observers\UserObserver;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'salutation',
        'name',
        'mother_name',
        'mobile',
        'email',
        'dob',
        'password',
        'application_status',
        'base64_pwd',
        'is_active',
        'ip_address',
        'declare1',
        'declare2',
        'declare3',
        'declare4',
        'declare5',
        'photo',
        'sign'
    ];
    public function payment()
    {
        return $this->hasOne(Payment::class,'user_id','id');
    }
    
}
