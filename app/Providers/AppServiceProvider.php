<?php

namespace App\Providers;
use DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        if ( env('APP_ENV')!=='local') {
            URL::forceScheme('https');
        }

        // try {
        //     DB::connection()->getPDO();
        //     dump('Database connected: ' . \DB::connection()->getDatabaseName());
        // }
         
        // catch (\Exception $e) {
        //     dump('Database not connected: ' . $e->getMessage());
        // }
    }
}
