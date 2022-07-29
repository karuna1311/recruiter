<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use App\Events\LoggingEvent;
use Illuminate\Support\Facades\Route;

trait Auditable
{
    public static function bootAuditable()
    {
        
        static::created(function (Model $model) {
            self::audit('created', $model);
        });

        static::updated(function (Model $model) {
            self::audit('updated', $model);
        });

        static::deleted(function (Model $model) {
            self::audit('deleted', $model);
        });
    }
    protected static function audit($description, $model)
    {
        $routeName=Route::currentRouteName();
        $logData=['logType'=>$routeName,'userId'=>auth()->id(),'logData'=>$model];
        event(new LoggingEvent($logData));
    }
}
