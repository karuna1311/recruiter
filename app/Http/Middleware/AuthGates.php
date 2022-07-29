<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();

        if (!app()->runningInConsole() && $user) {
            $appStatusArray=config('application.application_status');
            $application_status=$user->application_status ?? 0;
            if($application_status < 8){
                for($i=1;$i<=$user->application_status+1;$i++) {
                    if(array_key_exists($i, $appStatusArray)){
                        Gate::define($appStatusArray[$i]['gate_name'], function ()  {
                            return true;
                        });
                    }
                }
            }
            elseif($application_status==='8'){
                Gate::define($appStatusArray[9]['gate_name'], function ()  {
                    return true;
                });
            }elseif($application_status==='9'){
                Gate::define($appStatusArray[10]['gate_name'], function ()  {
                    return true;
                });
            }elseif($application_status==='10'){
                Gate::define($appStatusArray[11]['gate_name'], function ()  {
                    return true;
                });
                Gate::define('applied_session', function ()  {
                    return true;
                });
            }
        }
        return $next($request);
    }
}
