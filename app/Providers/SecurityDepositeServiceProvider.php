<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Facades\SecurityDepositeClass;

class SecurityDepositeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('SecurityDepositeClass',function(){
            return new SecurityDepositeClass();
        });
    }
}
