<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait MultiTenantModelTrait
{
    public static function bootMultiTenantModelTrait()
    {
        if (!app()->runningInConsole() && auth()->check()) {
            static::creating(function ($model)  {
                $model->user_id = auth()->id();
                $model->is_active ='1';
            });
            static::addGlobalScope('user_id', function (Builder $builder) {
                $builder->where('is_active','1')->where('user_id', auth()->id());
            }); 
        }
    }
}
